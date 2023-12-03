<?php

namespace Epush\Core\MessageRecipient\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageRecipient\Infra\Database\Model\MessageRecipient;
use Epush\Core\MessageRecipient\Infra\Database\Repository\Contract\MessageRecipientRepositoryContract;

class MessageRecipientRepository implements MessageRecipientRepositoryContract
{
    public function __construct(

        private MessageRecipient $messageRecipient
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->messageRecipient->with([
                'message',
                'messageGroupRecipient' => ['messageGroup']
            ])->paginate($take)->toArray();

        });
    }

    public function insert(string $messageID, array $messageGroupRecipientIDs, $status = 'Initialized'): array
    {
        return DB::transaction(function () use ($messageID, $messageGroupRecipientIDs, $status) {

            foreach ($messageGroupRecipientIDs as $messageGroupRecipientID) {
                $this->messageRecipient->updateOrCreate([
                    'message_id' => $messageID,
                    'message_group_recipient_id' => $messageGroupRecipientID,
                ], [
                    'message_id' => $messageID,
                    'message_group_recipient_id' => $messageGroupRecipientID,
                    'status' => $status
                ]);
            }
    
            return $this->messageRecipient->with([
                'message',
                'messageGroupRecipient' => ['messageGroup']
            ])->where('message_id', $messageID)->get()->toArray();

        });
    }

    public function update(string $messageID, array $data): array
    {
        return DB::transaction(function () use ($messageID, $data) {

            $this->messageRecipient->where('message_id', $messageID)->update($data);
            return $this->messageRecipient->where('message_id', $messageID)->get()->toArray();
        }); 
    }

    public function delete(string $messageID): bool
    {
        return DB::transaction(function () use ($messageID) {

            return $this->messageRecipient->where('message_id', $messageID)->delete();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $messageRecipient = $this->messageRecipient->with([
                'message',
                'messageGroupRecipient' => ['messageGroup']
            ]);

            $messageRecipient = match ($column)
            {
                "message", "content", "message_content" => 
                $messageRecipient->whereHas('message', function ($query) use ($value) {
                    $query->whereRaw("LOWER(content) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                "group", "message_group", "group_name" => 
                $messageRecipient->whereHas('messageGroupRecipient', function ($query) use ($value) {
                    $query->whereHas('messageGroup', function ($query) use ($value) {
                        $query->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($value) . '%']);
                    });
                }),

                "number", "attributes" => 
                $messageRecipient->whereHas('messageGroupRecipient', function ($query) use ($column, $value) {
                    $query->whereRaw("LOWER($column) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $messageRecipient->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            return $messageRecipient->paginate($take)->toArray();
        });
    }
}