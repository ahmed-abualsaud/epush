<?php

namespace Epush\Core\Partner\App\Service;


use Epush\Core\Partner\App\Contract\PartnerServiceContract;
use Epush\Core\Partner\App\Contract\PartnerDatabaseServiceContract;

use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class PartnerService implements PartnerServiceContract
{
    public function __construct(

        private PartnerDatabaseServiceContract $partnerDatabaseService,
        private InterprocessCommunicationEngineContract $communicationEngine

    ) {}


    public function list(int $take): array
    {
        $partners = $this->partnerDatabaseService->paginatePartners($take);
        $usersID = array_column($partners['data'], 'user_id');
        $users = $this->communicationEngine->broadcast("auth:user:get-users", $usersID)[0];
        $partners['data'] = tableWith($partners['data'], $users, "user_id");
        return $partners;
    }

    public function get(string $userID): array
    {
        $partner = $this->partnerDatabaseService->getPartner($userID);
        $user = $this->communicationEngine->broadcast("auth:user:get-user", $userID)[0];
        $result =  array_replace_recursive($user, $partner);
        $result['id'] = $userID;
        $result['partner_id'] = $partner['id'] ?? null;
        return $result;
    }


    public function add(array $partner, array $user): array
    {
        $user = $this->communicationEngine->broadcast("auth:user:add-user", $user, 'partner')[0];
        $partner['user_id'] = $user['id'];
        $partner = $this->partnerDatabaseService->addPartner($partner);

        $result =  array_replace_recursive($user, $partner);
        $result['id'] = $partner['user_id'];
        $result['partner_id'] = $partner['id'];
        return $result;
    }

    public function update(string $userID, array $partner, array $user): array
    {
        $user = $this->communicationEngine->broadcast("auth:user:update-user", $userID, $user)[0];
        $partner = $this->partnerDatabaseService->updatePartner($userID, $partner);
        return tableWith([$partner], [$user], "user_id")[0];
    }

    public function delete(string $userID): bool
    {
        return $this->partnerDatabaseService->deletePartner($userID) && $this->communicationEngine->broadcast("auth:user:delete-user", $userID)[0];
    }

    public function searchColumn(string $column, string $value, bool $searchPartner = true, int $take = 10): array
    {
        if ($searchPartner) {
            $partners = $this->partnerDatabaseService->searchPartnerColumn($column, $value, $take);
            $usersID = array_column($partners['data'], 'user_id');
            $users = $this->communicationEngine->broadcast("auth:user:get-users", $usersID)[0];
            $partners['data'] = tableWith($partners['data'], $users, "user_id");
            return $partners;
        } else {
            $partners = $this->partnerDatabaseService->paginatePartners(1000000000000);
            $usersID = array_column($partners['data'], 'user_id');
            $users = $this->communicationEngine->broadcast("auth:user:search-column", $column, $value, $take, $usersID)[0];
            $usersID = array_column($users['data'], 'id');
            $partners = $this->partnerDatabaseService->getPartners($usersID);
            $users['data'] = tableWith($partners, $users['data'], "user_id");
            return $users;
        }

    }
}