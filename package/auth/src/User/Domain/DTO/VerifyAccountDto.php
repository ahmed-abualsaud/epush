<?php

namespace Epush\Auth\User\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class VerifyAccountDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'email' => 'required|exists:users',
            'otp' => 'required',
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

    public function getOtp(): string
    {
        return $this->data['otp']?? '';
    }
}