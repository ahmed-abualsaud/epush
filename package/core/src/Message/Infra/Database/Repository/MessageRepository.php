<?php

namespace Epush\Core\Message\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;

use Epush\Core\Message\Infra\Database\Model\Message;
use Epush\Core\Message\Infra\Database\Repository\Contract\MessageRepositoryContract;

class MessageRepository implements MessageRepositoryContract
{
    public function __construct(

        private Message $message
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->message->with(['language', 'recipients', 'segments'])->paginate($take)->toArray();

        });
    }

    public function get(string $messageID): array
    {
        return DB::transaction(function () use ($messageID) {

            $message =  $this->message->with(['language', 'recipients', 'segments'])->where('id', $messageID)->first();
            return empty($message) ? [] : $message->toArray();
        });
    }

    public function getMessagesByOrdersID(array $ordersID, int $take = 10): array
    {
        return DB::transaction(function () use ($ordersID, $take) {

            return $this->message->whereIn('order_id', $ordersID)->paginate($take)->toArray();

        });
    }

    public function getMessagesBySendersID(array $sendersID, int $take = 10): array
    {
        return DB::transaction(function () use ($sendersID, $take) {

            return $this->message->whereIn('sender_id', $sendersID)->paginate($take)->toArray();

        });
    }

    public function create(array $message): array
    {
        return DB::transaction(function () use ($message) {

            return $this->message->create($message)->toArray();
        });
    }

    public function insert(array $messages): array
    {
        return DB::transaction(function () use ($messages) {

            $input = [];

            foreach ($messages['content'] as $content) {
                $input[] = [
                    'sender_id' => $messages['sender_id'],
                    'order_id' => $messages['order_id'],
                    'message_language_id' => $messages['message_language_id'],
                    'content' => $content,
                    'notes' => array_key_exists('notes', $messages)? $messages['notes'] : null,
                    'single_message_cost' => $messages['single_message_cost'],
                    'total_cost' => $messages['total_cost'],
                    'scheduled_at' => array_key_exists('scheduled_at', $messages)? $messages['scheduled_at'] : date("Y-m-d H:i:s"),
                    'number_of_segments' => $messages['number_of_segments'],
                    'number_of_recipients' => $messages['number_of_recipients'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
            }

            $this->message->insert($messages);
            return $this->message->whereIn('content', $messages['content'])->get()->toArray();
        });
    }

    public function delete(string $messageID): bool
    {
        return DB::transaction(function () use ($messageID) {

            return $this->message->where('id', $messageID)->delete();

        }); 
    }

    public function update(string $messageID, array $data): array
    {
        return DB::transaction(function () use ($messageID, $data) {

            $message = $this->message->where('id', $messageID)->firstOrFail();

            if (! empty($data)) {
                $message->update($data);
            }

            return $message->toArray();

        }); 
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $languageColumn = in_array($column, ["language", "language_name"])? "name" : $column;
            $message = $this->message->with(['language', 'recipients', 'segments']);

            $message = match ($column) 
            {
                "language", "language_name", "max_characters_length", "split_characters_length" => 
                $message->whereHas('language', function ($query) use ($languageColumn, $value) {
                    $query->whereRaw("LOWER(".$languageColumn.") LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $message->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            return $message->paginate($take)->toArray();
        });
    }
}