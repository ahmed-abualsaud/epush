<?php

namespace Epush\Auth\App\Service;

use Epush\Auth\App\Contract\UserServiceContract;
use Epush\Auth\App\Contract\CredentialsServiceContract;
use Epush\Auth\App\Contract\AuthDatabaseServiceContract;

use Epush\Shared\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\CoreServiceContract;
use Epush\Shared\App\Contract\FileServiceContract;

class UserService implements UserServiceContract
{
    public function __construct(

        private SMSServiceContract $smsService,
        private FileServiceContract $fileService,
        private CoreServiceContract $coreService,
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

    public function update(string $userID ,array $data): array
    {
        $avatar = $this->fileService->localStore('avatar', 'avatars');
        $avatar && $data['avatar'] = $avatar;
        return $this->authDatabaseService->updateUserByID($userID, $data);
    }

    public function signup(array $data, string $roleName): array
    {   
        $avatar = $this->fileService->localStore('avatar', 'avatars');
        $avatar && $data['avatar'] = $avatar;

        ! empty($data['websites']) && $websites = json_decode($data['websites'], true);
        unset($data['websites']);

        $user = $this->authDatabaseService->addUser($data);
        $password = $this->credentialsService->generatePassword($user['id']);

        $client = $this->coreService->addClient(['user_id' => $user['id']]);
        ! empty($websites) && $this->coreService->addClientWebsites($client['id'], $websites);

        $this->smsService->sendMessage($user['phone'], 'Your password is: '.$password);

        ! empty($roleName) && $this->authDatabaseService->assignUserRole($user['id'], $roleName);

        return $user;
    }

    public function delete(string $userID): bool
    {
        return $this->authDatabaseService->deleteUser($userID);
    }

    public function checkUserEnabledOrFail(string $userName): bool
    {
        return $this->authDatabaseService->checkUserEnabledOrFail($userName);
    }
}