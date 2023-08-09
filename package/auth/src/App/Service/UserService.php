<?php

namespace Epush\Auth\App\Service;

use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Auth\App\Contract\CredentialsServiceContract;
use Epush\Auth\App\Contract\AuthDatabaseServiceContract;

use Epush\Shared\App\Contract\FileServiceContract;

class UserService implements UserServiceContract
{
    public function __construct(

        private FileServiceContract $fileService,
        private CredentialsServiceContract $credentialsService,
        private AuthDatabaseServiceContract $authDatabaseService

    ) {}

    public function get(string $userID): array
    {
        return $this->authDatabaseService->getUser($userID);
    }


    public function list(int $take): array
    {
        return $this->authDatabaseService->paginateUsers($take);
    }


    public function getUsers(array $usersID): array
    {
        return $this->authDatabaseService->getUsers($usersID);
    }


    public function update(string $userID ,array $data): array
    {
        $updatedUser = $this->authDatabaseService->updateUserByID($userID, $data);
        array_key_exists("avatar", $data) && $data['avatar'] && $avatar = $this->fileService->localStore('avatar', $updatedUser['username'].'-avatar', 'avatars');
        ! empty($avatar) && $updatedUser = $this->authDatabaseService->updateUserByID($userID, ['avatar' => $avatar]);
        return $updatedUser;
    }


    public function signup(array $data, string $roleName = null): array
    {   
        $avatar = $this->fileService->localStore('avatar', $data['username'].'-avatar', 'avatars');
        $avatar && $data['avatar'] = $avatar;

        $data['password'] = $this->credentialsService->hashPassword($data['password']);
        $user = $this->authDatabaseService->addUser($data);

        ! empty($roleName) && $this->authDatabaseService->assignUserRole($user['id'], $roleName);

        return $user;
    }


    public function delete(string $userID): bool
    {
        $user = $this->authDatabaseService->getUser($userID);
        $user['avatar'] && $this->fileService->deleteLocalFile($user['avatar'], 'avatars');
        return $this->authDatabaseService->deleteUser($userID);
    }

    
    public function checkUserEnabledOrFail(string $userName): bool
    {
        return $this->authDatabaseService->checkUserEnabledOrFail($userName);
    }

    public function searchColumn(string $column, string $value, int $take = 10, array $usersID = null): array
    {
        return $this->authDatabaseService->searchUserColumn($column, $value, $take, $usersID);
    }
}