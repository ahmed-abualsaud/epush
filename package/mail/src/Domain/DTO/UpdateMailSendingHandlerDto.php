<?php

namespace Epush\Mail\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMailSendingHandlerDto implements DtoContract
{
    private static string $mailSendingHandlerID;

    public function __construct(string $mailSendingHandlerID, private array $data) 
    {
        self::$mailSendingHandlerID = $mailSendingHandlerID;
    }

    public static function rules(): array
    {
        return [
            'name' => 'string|unique:mail_sending_handlers,name,'.self::$mailSendingHandlerID,
            'handler_id' => 'exists:handlers,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}