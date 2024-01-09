<?php

namespace Epush\Core\MessageGroup\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageGroup\Infra\Database\Model\MessageGroup;
use Epush\Core\MessageGroup\Infra\Database\Repository\Contract\MessageGroupRepositoryContract;

class MessageGroupRepository implements MessageGroupRepositoryContract
{
    public function __construct(

        private MessageGroup $messageGroup
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->messageGroup
            // ->with(["recipients"])
            ->paginate($take)->toArray();

        });
    }

    public function get(string $messageGroupID): array
    {
        return DB::transaction(function () use ($messageGroupID) {

            $messageGroup =  $this->messageGroup
            // ->with(["recipients"])
            ->where('id', $messageGroupID)->first();
            return empty($messageGroup) ? [] : $messageGroup->toArray();
        });
    }

    public function getClientMessageGroups(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->messageGroup
            // ->with(["recipients"])
            ->where('user_id', $userID)->get()->toArray();
        });
    }

    public function create(array $messageGroup): array
    {
        return DB::transaction(function () use ($messageGroup) {

            return $this->messageGroup->updateOrCreate([
                'name' => $messageGroup['name'],
                'user_id' => $messageGroup['user_id']
            ], $messageGroup)->toArray();
        });
    }

    public function delete(string $messageGroupID): bool
    {
        return DB::transaction(function () use ($messageGroupID) {

            return $this->messageGroup->where('id', $messageGroupID)->delete();

        }); 
    }

    public function update(string $messageGroupID, array $data): array
    {
        return DB::transaction(function () use ($messageGroupID, $data) {

            $messageGroup = $this->messageGroup->where('id', $messageGroupID)->firstOrFail();

            if (! empty($data)) {
                $messageGroup->update($data);
            }

            return $messageGroup->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            return $this->messageGroup
                // ->with(["recipients"])
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }

    public function getMessageGroupsByUsersID(array $usersID, int $take): array
    {
        return DB::transaction(function () use ($usersID, $take) {

            $messageGroup = $this->messageGroup->whereIn('user_id', $usersID);
            $messageGroup = $take >= 1000000000000 ? $messageGroup->paginate($take, ['*'], 'page', 1) : $messageGroup->paginate($take);
            return $messageGroup->toArray();

        });
    }
}