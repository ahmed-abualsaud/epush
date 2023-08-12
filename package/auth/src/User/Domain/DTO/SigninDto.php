<?php

namespace Epush\Auth\User\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SigninDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'username' => 'required|string|exists:users'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUsername(): string
    {
        return $this->data['username']?? '';
    }

    public function getPassword(): string
    {
        return $this->data['password']?? '';
    }
}