<?php

namespace Epush\Core\Message\Infra\Database\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

            return $this->message->with([
                'segments',
                'language', 
                // 'recipients' => ['messageGroupRecipient']
            ])->latest()->paginate($take)->toArray();

        });
    }

    public function get(string $messageID): array
    {
        return DB::transaction(function () use ($messageID) {

            $message =  $this->message->with([
                'segments',
                'language', 
                // 'recipients' => ['messageGroupRecipient']
            ])->where('id', $messageID)->first();
            return empty($message) ? [] : $message->toArray();
        });
    }

    public function getClientMessages(string $userID, int $take = null): array
    {
        return DB::transaction(function () use ($userID, $take) {

            if ($take != null && $take > 0) {
                return $this->message->with([
                    'segments',
                    'language',
                    'sender',
                    // 'recipients' => ['messageGroupRecipient']
                ])
                ->where('user_id', $userID)
                ->latest()
                ->take($take)
                ->get()
                ->toArray();
            }
            return $this->message->with([
                'segments',
                'language',
                'sender',
                // 'recipients' => ['messageGroupRecipient']
            ])
            ->where('user_id', $userID)
            ->latest()
            ->get()
            ->toArray();

        });
    }

    public function getMessagesByUsersID(array $usersID, int $take = 10): array
    {
        return DB::transaction(function () use ($usersID, $take) {

            return $this->message->whereIn('user_id', $usersID)->paginate($take)->toArray();

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
                    'user_id' => $messages['user_id'],
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
                    'sender_ip' => $messages['sender_ip'],
                    'message_type' => $messages['message_type'],
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
            $message = $this->message->with([
                'segments',
                'language', 
                // 'recipients' => ['messageGroupRecipient']
            ]);

            $message = match ($column) 
            {
                'approved' => $message->where("approved", $value),
                "language", "language_name", "max_characters_length", "split_characters_length" => 
                $message->whereHas('language', function ($query) use ($languageColumn, $value) {
                    $query->whereRaw("LOWER(".$languageColumn.") LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $message->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            return $message->paginate($take)->toArray();
        });
    }

    public function getReadyToSendScheduledMessages(): array
    {
        return DB::transaction(function () {

            return $this->message
            // ->with([
            //     'recipients' => ['messageGroupRecipient']
            // ])
            ->where('sent', false)
            ->where('approved', true)
            ->where('scheduled_at', '<', Carbon::now())
            ->get()
            ->toArray();

        });
    }

    public function getClientMessagesStats(string $userID): array
    {
        return DB::transaction(function () use ($userID) {

            return $this->message
            ->selectRaw('COUNT(*) as number_of_messages')
            ->selectRaw('SUM(total_cost) as total_cost')
            ->selectRaw('SUM(number_of_recipients) as number_of_recipients')
            ->where('user_id', $userID)
            ->first()
            ->toArray();

        });
    }
}