<?php

namespace Epush\Ticket\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateTicketDto implements DtoContract
{
    private static string $ticketID;

    public function __construct(string $ticketID, private array $data) 
    {
        self::$ticketID = $ticketID;
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string|email',
            'phone' => 'string',
            'company_name' => 'string|exists:clients,company_name',
            'sender_name' => 'string|exists:senders,name',
            'content' => 'string',
            'status' => 'string|in:Initiated,Processing,Completed,Closed',
            'notes' => 'string|nullable',
            'mail_content' => 'string'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getMailContent(): string
    {
        return $this->data['mail_content'];
    }

    public function getTicket(): array
    {
        return subAssociativeArray([
            'user_id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'company_name',
            'sender_name',
            'content',
            'status',
            'notes'
        ], $this->data);
    }
}