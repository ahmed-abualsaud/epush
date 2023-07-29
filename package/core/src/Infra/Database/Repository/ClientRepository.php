<?php

namespace Epush\Core\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Infra\Database\Model\Client;
use Epush\Core\Infra\Database\Model\ClientWebsite;
use Epush\Core\Infra\Database\Repository\Contract\ClientRepositoryContract;

class ClientRepository implements ClientRepositoryContract
{
    public function __construct(

        private Client $client,

        private ClientWebsite $clientWebsite
        
    ) {}

    public function get(string $clientID): array
    {
        return DB::transaction(function () use ($clientID) {

            return $this->client->with('websites')->where('id', $clientID)->firstOrFail()->toArray();
        });
    }
    
    public function add(array $client): array
    {
        return DB::transaction(function () use ($client) {

            return $this->client->blindCreate($client);
        });
    }

    public function addClientWebsites(string $clientID, array $websites): array
    {
        return DB::transaction(function () use ($clientID, $websites) {

            $clientWebsites = array_map(function ($website) use ($clientID) {

                return [
                    'client_id' => $clientID,
                    'url' => $website['url'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

            }, $websites);

            $this->clientWebsite->insert($clientWebsites);

            return $this->clientWebsite->where('client_id', $clientID)->get()->toArray();
        });
    }
}