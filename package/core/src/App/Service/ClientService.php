<?php

namespace Epush\Core\App\Service;


use Epush\Core\App\Contract\ClientServiceContract;
use Epush\Core\App\Contract\CoreDatabaseServiceContract;

use Epush\Shared\App\Contract\SMSServiceContract;
use Epush\Shared\App\Contract\AuthServiceContract;
use Epush\Shared\App\Contract\FileServiceContract;
use Epush\Shared\App\Contract\MailServiceContract;

class ClientService implements ClientServiceContract
{
    public function __construct(

        private SMSServiceContract $smsService,
        private MailServiceContract $mailService,
        private FileServiceContract $fileService,
        private AuthServiceContract $authService,
        private CoreDatabaseServiceContract $coreDatabaseService

    ) {}


    public function get(string $userID): array
    {
        $client = $this->coreDatabaseService->getClient($userID);
        $user = $this->authService->getUser($userID);
        $result =  array_replace_recursive($user, $client);
        $result['id'] = $userID;
        $result['client_id'] = $client['id'] ?? null;
        return $result;
    }


    public function add(array $client, array $user): array
    {
        $avatar = $this->fileService->localStore('avatar', $client['username'].'-avatar', 'avatars');
        $avatar && $user['avatar'] = $avatar;

        ! empty($client['websites']) && $websites = json_decode($client['websites'], true);
        unset($client['websites']);

        $user = $this->authService->addUser($user, 'client');
        $password = $this->authService->generatePassword($user['id']);

        $client['user_id'] = $user['id'];
        $client = $this->coreDatabaseService->addClient($client);
        ! empty($websites) && $this->coreDatabaseService->addClientWebsites($client['id'], $websites);

        $this->smsService->sendMessage($user['phone'], 'Your password is: '.$password);
        $this->mailService->sendClientAddedMail($user['email'], $user);

        $result =  array_replace_recursive($user, $client);
        $result['id'] = $client['user_id'];
        $result['client_id'] = $client['id'];
        return $result;
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return $this->coreDatabaseService->addClientWebsites($clientID, $websites);
    }
}