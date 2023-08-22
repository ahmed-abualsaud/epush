<?php

namespace Epush\Core\Sender\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\Sender\Infra\Database\Model\Sender;
use Epush\Core\Sender\Infra\Database\Repository\Contract\SenderRepositoryContract;

class SenderRepository implements SenderRepositoryContract
{
    public function __construct(

        private Sender $sender
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->sender->paginate($take)->toArray();

        });
    }

    public function get(string $senderID): array
    {
        return DB::transaction(function () use ($senderID) {

            $sender = $this->sender->where('id', $senderID)->first();
            return empty($sender) ? [] : $sender->toArray();

        });
    }

    public function getClientSenders(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->sender->where('user_id', $userID)->get()->toArray();

        });
    }

    public function getSendersByID(array $sendersID): array
    {
        return DB::transaction(function () use ($sendersID) {

            return $this->sender->whereIn('id', $sendersID)->get()->toArray();

        });
    }

    public function create(array $sender): array
    {
        return DB::transaction(function () use ($sender) {

            $input = [
                'user_id' => $sender["user_id"], 
                'name' => $sender["name"],
                'approved' => $sender["approved"],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];

            return $this->sender->updateOrCreate([
                'user_id' => $sender["user_id"], 
                'name' => $sender["name"]
            ], $input)->toArray();

        });
    }

    public function delete(string $senderID): bool
    {
        return DB::transaction(function () use ($senderID) {

            return $this->sender->where('id', $senderID)->delete();

        });
    }

    public function update(string $senderID, array $data): array
    {
        return DB::transaction(function () use ($senderID, $data) {

            $sender = $this->sender->where('id', $senderID)->firstOrFail();

            if (! empty($data)) {
                $sender->update($data);
            }

            return $sender->toArray();

        });
    }

    public function getSendersByUsersID(array $usersID, int $take = 10): array
    {
        return DB::transaction(function () use ($usersID, $take) {

            $sender = $this->sender->whereIn('user_id', $usersID);
            $sender = $take >= 1000000000000 ? $sender->paginate($take, ['*'], 'page', 1) : $sender->paginate($take);
            return $sender->toArray();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $senders = $this->sender;

            if ($column === "approved") {
                $senders = $senders->where($column, $value);
            } else {
                $senders = $senders->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'");
            }

            $senders = $take >= 1000000000000 ? $senders->paginate($take, ['*'], 'page', 1) : $senders->paginate($take);
            return $senders->toArray();
        });
    }
}