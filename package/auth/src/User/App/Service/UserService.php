<?php

namespace Epush\Auth\User\App\Service;

use Epush\Auth\Role\App\Contract\RoleServiceContract;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Auth\User\App\Contract\UserDatabaseServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class UserService implements UserServiceContract
{
    public function __construct(

        
        private RoleServiceContract $roleService,
        private CredentialsServiceContract $credentialsService,
        private UserDatabaseServiceContract $userDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}

    public function get(string $userID): array
    {
        return $this->userDatabaseService->getUser($userID);
    }


    public function list(int $take): array
    {
        return $this->userDatabaseService->paginateUsers($take);
    }


    public function getUsers(array $usersID): array
    {
        return $this->userDatabaseService->getUsers($usersID);
    }


    public function getUserByUsername(string $username): array
    {
        return $this->userDatabaseService->getUserByUsername($username);
    }


    public function update(string $userID ,array $data): array
    {
        $updatedUser = $this->userDatabaseService->updateUserByID($userID, $data);
        if (array_key_exists("avatar", $data) && (empty($data['avatar']) || $data['avatar'] == "null")) {
            return $this->userDatabaseService->updateUserByID($userID, ['avatar' => null]);
        }
        array_key_exists("avatar", $data) && $data['avatar'] && $avatar = $this->communicationEngine->broadcast('file:store', 'avatar', 'avatars', $updatedUser['username'].'-avatar')[0];
        ! empty($avatar) && $updatedUser = $this->userDatabaseService->updateUserByID($userID, ['avatar' => $avatar]);
        return $updatedUser;
    }


    public function signup(array $data, string $roleName = null): array
    {   
        $avatar = $this->communicationEngine->broadcast('file:store', 'avatar', 'avatars', $data['username'].'-avatar')[0];
        $avatar && $data['avatar'] = $avatar;

        $data['password'] = $this->credentialsService->hashPassword($data['password']);
        $user = $this->userDatabaseService->addUser($data);

        ! empty($roleName) && $this->userDatabaseService->assignUserRole($user['id'], $roleName);

        return $user;
    }

    public function signin(string $username, string $password): array
    {
        $this->checkUserEnabledOrFail($username);
        return $this->credentialsService->signin($username, $password);
    }

    public function delete(string $userID): bool
    {
        $user = $this->userDatabaseService->getUser($userID);
        $user['avatar'] && $this->communicationEngine->broadcast('file:delete', $user['avatar'], 'avatars')[0];
        return $this->userDatabaseService->deleteUser($userID);
    }

    public function getUserRoles(string $userID): array
    {
        return $this->userDatabaseService->getUserRoles($userID);
    }

    public function getUserPermissions(string $userID): array
    {
        return $this->userDatabaseService->getUserPermissions($userID);
    }

    public function getAllUserPermissions(string $userID): array
    {
        $roles = $this->userDatabaseService->getUserRoles($userID);
        if (empty($roles)) { return []; }

        $userRolesID = array_column($roles, 'id');
        $permissions = $this->roleService->getRolesPermissions($userRolesID);

        $handlersID = array_column($permissions, 'handler_id');
        $handlers = $this->communicationEngine->broadcast("orchi:handler:get-handlers-by-id", $handlersID)[0];

        $detailedPermissions = innerJoinTableArrays($permissions, $handlers, 'handler_id');
        return $detailedPermissions;
    }

    public function assignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->userDatabaseService->assignUserRoles($userID, $rolesID);
    }

    public function assignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->userDatabaseService->assignUserPermissions($userID, $permissionsID);
    }

    public function unassignUserRoles(string $userID, array $rolesID): bool
    {
        return $this->userDatabaseService->unassignUserRoles($userID, $rolesID);
    }

    public function unassignUserPermissions(string $userID, array $permissionsID): bool
    {
        return $this->userDatabaseService->unassignUserPermissions($userID, $permissionsID);
    }
    
    public function checkUserEnabledOrFail(string $userName): bool
    {
        return $this->userDatabaseService->checkUserEnabledOrFail($userName);
    }

    public function searchColumn(string $column, string $value, int $take = 10, array $usersID = null): array
    {
        return $this->userDatabaseService->searchUserColumn($column, $value, $take, $usersID);
    }

    public function verifyAccount(string $email, $otp): array
    {
        $result = $this->credentialsService->validateOtp($email, $otp);

        return [
            'success' => $result['status'],
            'message' => $result['message']
        ];
    }

    public function forgetPassword(string $email): array
    {
        $otp = $this->credentialsService->generateOtp($email);
        if ($otp['status']) {
            $this->communicationEngine->broadcast("mail:send-to", $email, "Email Verification", "Your verification code is: " . $otp['token']);
            return [
                'success' => true,
                'message' => "OTP token sent successfully, please check your email inbox"
            ];
        }

        return [
            'success' => false,
            'message' => "Failed to generate OTP token"
        ];
    }
}