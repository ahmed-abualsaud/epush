<?php

namespace Epush\Core\IPWhitelist\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\IPWhitelist\Infra\Database\Model\IPWhitelist;
use Epush\Core\IPWhitelist\Infra\Database\Repository\Contract\IPWhitelistRepositoryContract;


class IPWhitelistRepository implements IPWhitelistRepositoryContract
{
    public function __construct(

        private IPWhitelist $ipWhitelist
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->ipWhitelist->all()->toArray();

        });
    }

    public function get(string $ipID): array
    {
        return DB::transaction(function () use ($ipID) {

            $ipWhitelist = $this->ipWhitelist->where('id', $ipID)->first();
            return empty($ipWhitelist) ? [] : $ipWhitelist->toArray();
        });
    }

    public function create(array $ip): array
    {
        return DB::transaction(function () use ($ip) {

            return $this->ipWhitelist->create($ip)->toArray();
        });
    }

    public function delete(string $ipID): bool
    {
        return DB::transaction(function () use ($ipID) {

            return $this->ipWhitelist->where('id', $ipID)->delete();

        }); 
    }

    public function update(string $ipID, array $ip): array
    {
        return DB::transaction(function () use ($ipID, $ip) {

            $ipWhitelist = $this->ipWhitelist->where('id', $ipID)->firstOrFail();

            if (! empty($ip)) {
                $ipWhitelist->update($ip);
            }

            return $ipWhitelist->toArray();

        }); 
    }

    public function getUserIPWhitelist(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->ipWhitelist->where('user_id', $userID)->get()->toArray();
        });
    }

    public function getUserAllowedWhitelist(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->ipWhitelist->where('user_id', $userID)->where('allowed', true)->get()->toArray();
        });
    }
}