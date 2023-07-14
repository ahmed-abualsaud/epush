<?php

namespace Epush\Auth\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SignupDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'username' => 'unique:users|required|string',
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'email' => 'unique:users|required|email',
            'phone' => 'unique:users|required|string|regex:/^\d{3}-?\d{3}-?\d{5}$/',
            'contact_name' => 'unique:users|required|string',
            'religion' => 'required|string',
            'role' => 'required|exists:roles,name'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function toTableArray(): array
    {
        return array_intersect_key($this->data, array_flip([
            'username',
            'password',
            'email',
            'phone',
            'contact_name',
            'religion',
        ]));
    }

    public function getRole(): string
    {
        return $this->data['role'];
    }
}