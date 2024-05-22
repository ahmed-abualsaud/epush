<?php

namespace Epush\Auth\User\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Epush\Auth\User\Infra\Database\Model\BlockedIP;
use Epush\Auth\User\Infra\Database\Repository\Contract\BlockedIPRepositoryContract;

class BlockedIPRepository implements BlockedIPRepositoryContract
{
    public function __construct(

        private BlockedIP $blockedIP

    ) {}

    public function create(array $data): array
    {
        return DB::transaction(function () use ($data) {

            return $this->blockedIP->updateOrCreate(
                ['ip' => $data['ip']],
                ['tries' => isset($data['tries']) ? $data['tries'] : DB::raw('tries + 1')]
            )->toArray();

        });
    }

    public function getByIP(string $ip): array
    {
        return DB::transaction(function () use ($ip) {

            $blockedIP =  $this->blockedIP->where('ip', $ip)->first();
            return empty($blockedIP) ? [] : $blockedIP->toArray();

        });
    }
}