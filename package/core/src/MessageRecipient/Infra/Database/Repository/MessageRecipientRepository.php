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

            return $this->messageRecipient->paginate($take)->toArray();

        });
    }

    public function insert(string $messageID, array $messageRecipients): array
    {
        return DB::transaction(function () use ($messageID, $messageRecipients) {

            $messageRecipients = array_map(function ($messageRecipient) use ($messageID) {

                return [
                    'message_id' => $messageID,
                    'number' => $messageRecipient['number'],
                    'status' => 'Initialized',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
            }, $messageRecipients);
    
            $this->messageRecipient->insert($messageRecipients);
    
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

            return $this->messageRecipient
                ->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
                ->paginate($take)->toArray();
        });
    }
}