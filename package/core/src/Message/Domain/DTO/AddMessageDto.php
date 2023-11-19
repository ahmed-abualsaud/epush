<?php

namespace Epush\Core\Message\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddMessageDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sender_id' => 'required|exists:senders,id',
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'message_language_id' => 'required|exists:message_languages,id',
            'content' => 'required|string',
            'notes' => 'string',
            'scheduled_at' => 'string|nullable',
            'group_recipients' => 'required|array',
            'group_recipients.*.name' => 'required|string',
            'group_recipients.*.user_id' => 'required|exists:users,id',
            'group_recipients.*.recipients' => 'required|array',
            'group_recipients.*.recipients.*.number' => 'required|string',
            'group_recipients.*.recipients.*.attributes' => 'string|nullable',
            'segments' => 'required|array',
            'segments.*.number' => 'required|integer',
            'segments.*.content' => 'required|string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUserID(): string
    {
        return $this->data['user_id'];
    }

    public function getMessage(): array
    {
        $this->data['number_of_segments'] = count($this->getSegments());
        $this->data['number_of_recipients'] = $this->getNumberOfRecipients();

        return subAssociativeArray([

            'user_id',
            'sender_id',
            'order_id',
            'message_language_id',
            'content',
            'scheduled_at',
            'number_of_segments',
            'number_of_recipients'

        ], $this->data);
    }

    public function getMessageGroupRecipients(): array
    {
        return $this->data['group_recipients'];
    }

    public function getSegments(): array
    {
        return $this->data['segments'];
    }

    public function getNumberOfRecipients(): int
    {
        $numOfRecipients = 0;

        foreach ($this->data['group_recipients'] as $groupRecipient) {
            $numOfRecipients += count($groupRecipient['recipients']);
        };

        return $numOfRecipients;
    }
}