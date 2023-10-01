<?php

namespace Epush\Core\SenderConnection\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;

use Epush\Core\SenderConnection\Infra\Database\Model\SenderConnection;
use Epush\Core\SenderConnection\Infra\Database\Repository\Contract\SenderConnectionRepositoryContract;

class SenderConnectionRepository implements SenderConnectionRepositoryContract
{
    public function __construct(

        private SenderConnection $senderConnection
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->senderConnection->with([
                'smsc' => function (Builder $query) {
                    $query->with(['country', 'operator', 'smsc']);
                }
            ])->paginate($take)->toArray();

        });
    }

    public function get(string $senderConnectionID): array
    {
        return DB::transaction(function () use ($senderConnectionID) {

            $senderConnection =  $this->senderConnection->where('id', $senderConnectionID)->first();
            return empty($senderConnection) ? [] : $senderConnection->toArray();

        });
    }

    public function getSenderConnections(string $senderID): array
    {
        return DB::transaction(function () use ($senderID) {

            return $this->senderConnection->with([
                'smsc' => function (Builder $query) {
                    $query->with(['country', 'operator', 'smsc']);
                }
            ])->where('sender_id', $senderID)->get()->toArray();

        });
    }

    public function getSendersConnectionsBySMSCsID(array $smscsID, int $take = 10): array
    {
        return DB::transaction(function () use ($smscsID, $take) {

            return $this->senderConnection->with([
                'smsc' => function (Builder $query) {
                    $query->with(['country', 'operator', 'smsc']);
                }
            ])->whereIn('smsc_id', $smscsID)->paginate($take)->toArray();

        });
    }

    public function getSendersConnectionsBySendersID(array $sendersID, int $take = 10): array
    {
        return DB::transaction(function () use ($sendersID, $take) {

            return $this->senderConnection->with([
                'smsc' => function (Builder $query) {
                    $query->with(['country', 'operator', 'smsc']);
                }
            ])->whereIn('sender_id', $sendersID)->paginate($take)->toArray();

        });
    }
    
    public function create(array $senderConnection): array
    {
        return DB::transaction(function () use ($senderConnection) {

            $input = [
                'sender_id' => $senderConnection["sender_id"], 
                'smsc_id' => $senderConnection["smsc_id"],
                'approved' => $senderConnection["approved"],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            return $this->senderConnection->updateOrCreate([
                'sender_id' => $senderConnection["sender_id"], 
                'smsc_id' => $senderConnection["smsc_id"]
            ], $input)->toArray();
        });
    }

    public function delete(string $senderConnectionID): bool
    {
        return DB::transaction(function () use ($senderConnectionID) {

            return $this->senderConnection->where('id', $senderConnectionID)->delete();

        });
    }

    public function update(string $senderConnectionID, array $data): array
    {
        return DB::transaction(function () use ($senderConnectionID, $data) {

            $senderConnection = $this->senderConnection->where('id', $senderConnectionID)->firstOrFail();

            if (! empty($data)) {
                $senderConnection->update($data);
            }

            return $senderConnection->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $senderConnection = $this->senderConnection->with([
                'smsc' => function (Builder $query) {
                    $query->with(['country', 'operator', 'smsc']);
                }
            ]);

            if ($column === "approved") {
                $senderConnection = $senderConnection->where($column, $value);
            } else {
                $senderConnection = $senderConnection->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'");
            }

            return $senderConnection->paginate($take)->toArray();
        });
    }
}