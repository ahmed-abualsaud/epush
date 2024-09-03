<?php

namespace Epush\Core\MessageGroupRecipient\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageGroupRecipient\Infra\Database\Model\MessageGroupRecipient;
use Epush\Core\MessageGroupRecipient\Infra\Database\Repository\Contract\MessageGroupRecipientRepositoryContract;

class MessageGroupRecipientRepository implements MessageGroupRecipientRepositoryContract
{
    public function __construct(

        private MessageGroupRecipient $messageGroupRecipient
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->messageGroupRecipient->with(["messageGroup"])->latest()->paginate($take)->toArray();

        });
    }

    public function get(string $messageGroupRecipientID): array
    {
        return DB::transaction(function () use ($messageGroupRecipientID) {

            $messageGroupRecipient =  $this->messageGroupRecipient->with(["messageGroup"])->where('id', $messageGroupRecipientID)->first();
            return empty($messageGroupRecipient) ? [] : $messageGroupRecipient->toArray();
        });
    }

    public function getMessageRecipients(string $messageID, int $take): array
    {
        return DB::transaction(function () use ($messageID, $take) {

            return $this->messageGroupRecipient
            ->join('message_recipients', 'message_recipients.message_group_recipient_id', 'message_group_recipients.id')
            ->where('message_id', $messageID)
            ->orderBy('message_recipients.created_at', 'desc')->paginate($take)->toArray();
        });
    }

    public function getMessageGroupRecipients(string $messageGroupID, int $take): array
    {
        return DB::transaction(function () use ($messageGroupID, $take) {

            return $this->messageGroupRecipient
            ->where('message_group_id', $messageGroupID)
            ->latest()->paginate($take)->toArray();
        });
    }
    
    public function insert(string $groupID, array $messageGroupRecipients): array
    {
        return DB::transaction(function () use ($groupID, $messageGroupRecipients) {

            $batchSize = 4000;
            $chunks = array_chunk($messageGroupRecipients, $batchSize);
            $numbers = array_column($messageGroupRecipients, 'number');
            $existedNumbers = $this->messageGroupRecipient->where('message_group_id', $groupID)->whereIn('number', $numbers)->get()->pluck('number')->toArray();

            $upsertData = [];
            foreach ($chunks as $chunk) {
                $upsertData = [];
                foreach ($chunk as $messageGroupRecipient) {
                    if (! in_array($messageGroupRecipient['number'], $existedNumbers)) {
                        $upsertData[] = [
                            'message_group_id' => $groupID,
                            'number' => $messageGroupRecipient['number'],
                            'attributes' => array_key_exists('attributes', $messageGroupRecipient) ? $messageGroupRecipient['attributes'] : null
                        ];
                    }
                }

                $update = ['attributes'];
                $uniqueBy = ['message_group_id', 'number'];
                $this->messageGroupRecipient->upsert($upsertData, $uniqueBy, $update);
            }

            return [
                'count' => $this->messageGroupRecipient->where('message_group_id', $groupID)->count(),
                'added_count' => count(array_unique(array_diff($numbers, $existedNumbers)))
            ];
        });
    }

    public function insertAndFetch(string $groupID, array $messageGroupRecipients): array
    {
        return DB::transaction(function () use ($groupID, $messageGroupRecipients) {

            $batchSize = 4000;
            $chunks = array_chunk($messageGroupRecipients, $batchSize);
            $existedNumbers = $this->messageGroupRecipient->where('message_group_id', $groupID)->whereIn('number', array_column($messageGroupRecipients, 'number'))->get()->pluck('number')->toArray();

            $upsertData = [];
            foreach ($chunks as $chunk) {
                $upsertData = [];
                foreach ($chunk as $messageGroupRecipient) {
                    if (! in_array($messageGroupRecipient['number'], $existedNumbers)) {
                        $upsertData[] = [
                            'message_group_id' => $groupID,
                            'number' => $messageGroupRecipient['number'],
                            'attributes' => array_key_exists('attributes', $messageGroupRecipient) ? $messageGroupRecipient['attributes'] : null
                        ];
                    }
                }

                $update = ['attributes'];
                $uniqueBy = ['message_group_id', 'number'];
                $this->messageGroupRecipient->upsert($upsertData, $uniqueBy, $update);
            }

            return $this->messageGroupRecipient->where('message_group_id', $groupID)->get()->toArray();
        });
    }

    public function delete(string $messageGroupRecipientID): bool
    {
        return DB::transaction(function () use ($messageGroupRecipientID) {

            return $this->messageGroupRecipient->where('id', $messageGroupRecipientID)->delete();

        }); 
    }

    public function deleteGroupRecipients(string $groupID): bool
    {
        return DB::transaction(function () use ($groupID) {

            return $this->messageGroupRecipient->where('message_group_id', $groupID)->delete();

        }); 
    }

    public function update(string $messageGroupRecipientID, array $data): array
    {
        return DB::transaction(function () use ($messageGroupRecipientID, $data) {

            $messageGroupRecipient = $this->messageGroupRecipient->where('id', $messageGroupRecipientID)->firstOrFail();

            if (! empty($data)) {
                $messageGroupRecipient->update($data);
            }

            return $messageGroupRecipient->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $messageGroupRecipient = $this->messageGroupRecipient->with(["messageGroup"]);

            $messageGroupRecipient = match ($column) 
            {
                "group", "group_name", "message_group_name" => 
                $messageGroupRecipient->whereHas('messageGroup', function ($query) use ($value) {
                    $query->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $messageGroupRecipient->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };
            return $messageGroupRecipient->latest()->paginate($take)->toArray();
        });
    }
}