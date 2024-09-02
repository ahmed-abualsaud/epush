<?php

namespace Epush\Auth\User\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SigninDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'username' => 'required|string|exists:users',
            'password' => 'required|string',
            'remember_me' => 'boolean',
            'recaptcha_token' => 'string|nullable'
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['remember_me']) && $this->data['remember_me'] = $this->data['remember_me'] == 'true';
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

    public function getRememberMe(): string
    {
        ! empty($this->data['remember_me']) && $this->data['remember_me'] = $this->data['remember_me'] == 'true';
        return $this->data['remember_me'] ?? false;
    }

    public function getRecaptchaToken(): string
    {
        return $this->data['recaptcha_token']?? '';
    }
}