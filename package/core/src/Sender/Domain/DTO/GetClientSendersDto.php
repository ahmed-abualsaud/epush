<?php

namespace Epush\Core\Sender\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class GetClientSendersDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'exists:clients,user_id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUserID(): string
    {
        return $this->data['user_id']?? '';
    }
}