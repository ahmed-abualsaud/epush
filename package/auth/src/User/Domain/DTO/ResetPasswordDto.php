<?php

namespace Epush\Auth\User\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ResetPasswordDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'email' => 'required|exists:users',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/|confirmed',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getEmail(): string
    {
        return $this->data['email']?? '';
    }

    public function getPassword(): string
    {
        return $this->data['password']?? '';
    }
}