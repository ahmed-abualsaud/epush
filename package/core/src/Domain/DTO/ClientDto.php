<?php

namespace Epush\Core\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ClientDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'exists:users,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getClientID(): string
    {
        return $this->data['user_id']?? '';
    }
}