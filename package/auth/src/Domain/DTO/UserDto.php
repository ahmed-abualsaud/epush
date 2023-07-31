<?php

namespace Epush\Auth\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UserDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'exists:client,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUserId(): string
    {
        return $this->data['user_id']?? '';
    }
}