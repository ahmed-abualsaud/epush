<?php

namespace Epush\Core\Client\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Client\Infra\Database\Model\Client;
use Epush\Core\Client\Infra\Database\Model\ClientWebsite;
use Epush\Core\Client\Infra\Database\Repository\Contract\ClientRepositoryContract;
use Epush\Shared\Infra\Utils\WalletActions;

class ClientRepository implements ClientRepositoryContract
{
    public function __construct(

        private Client $client,

        private ClientWebsite $clientWebsite
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            $client = $this->client->with(['websites', 'sales', 'businessField']);
            $client = $take >= 1000000000000 ? $client->paginate($take, ['*'], 'page', 1) : $client->paginate($take);
            return $client->toArray();

        });
    }

    public function get(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            $client =  $this->client->with(['websites', 'sales', 'businessfield'])->where('user_id', $userID)->first();
            return empty($client) ? [] : $client->toArray();

        });
    }
    
    public function create(array $client): array
    {
        return DB::transaction(function () use ($client) {

            return $this->client->blindCreate($client);

        });
    }

    public function delete(string $userID): bool
    {
        return DB::transaction(function () use ($userID) {

            return $this->client->where('user_id', $userID)->delete();

        }); 
    }

    public function update(string $userID, array $data): array
    {
        return DB::transaction(function () use ($userID, $data) {

            $client = $this->client->with(['websites', 'sales', 'businessfield'])->where('user_id', $userID)->firstOrFail();

            if (! empty($data)) {
                $client->update($data);
            }

            return $client->toArray();

        }); 
    }

    public function updateWallet(string $userID, float $cost, string $action): array
    {
        return DB::transaction(function () use ($userID, $cost, $action) {

            $client = $this->client->with(['websites', 'sales', 'businessfield'])->where('user_id', $userID)->firstOrFail();

            if ($action === WalletActions::SET->value)
            {
                $client->update(['balance' => $cost]);
            }

            if ($action === WalletActions::REFUND->value)
            {
                $client->update(['balance' => $client->balance + $cost]);
            }

            if ($action === WalletActions::DEDUCT->value)
            {
                $client->balance - $cost < 0 ?
                throwHttpException(400, "You don't have enough money") :
                $client->update(['balance' => $client->balance - $cost]);
            }

            return $client->toArray();

        }); 
    }

    public function getClients(array $usersID): array
    {
        return DB::transaction(function () use ($usersID) {

            return $this->client->with(['websites', 'sales', 'businessfield'])->whereIn('user_id', $usersID)->get()->toArray();

        }); 
    }

    public function getClientsBySalesID(array $salesID): array
    {
        return DB::transaction(function () use ($salesID) {

            return $this->client->with(['websites', 'sales', 'businessfield'])->whereIn('sales_id', $salesID)->get()->toArray();

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

    public function updateClientWebsites(string $clientID, array $newWebsites, bool $sync = false): array
    {
        return DB::transaction(function () use ($clientID, $newWebsites, $sync) {

            if ($sync) {
                $this->clientWebsite->where('client_id', $clientID)->delete();
                return empty($newWebsites) ? [] : $this->addClientWebsites($clientID, $newWebsites);
            }

            $ids = array_column($newWebsites, 'id');
            $urls = array_column($newWebsites, 'url');
            
            $this->clientWebsite->where('client_id', $clientID)->whereIn('id', $ids)
                ->update([
                    'url' => DB::raw("CASE id " . implode(" ", array_map(function ($id, $url) {
                        return "WHEN $id THEN '$url'";
                    }, $ids, $urls)) . " END")
                ]);
            
            return $this->clientWebsite->whereIn('id', $ids)->get()->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $client = $this->client->with(['websites', 'sales', 'businessfield']);
            if (in_array($column, ["website", 'websites'])) {
                $client = $client->whereHas('websites', function ($query) use ($value) {
                    $query->whereRaw("LOWER(url) LIKE ?", ['%' . strtolower($value) . '%']);
                });
            } else {
                $client = $client->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'");
            }

            $client = $take >= 1000000000000 ? $client->paginate($take, ['*'], 'page', 1) : $client->paginate($take);
            return $client->toArray();
        });
    }
}