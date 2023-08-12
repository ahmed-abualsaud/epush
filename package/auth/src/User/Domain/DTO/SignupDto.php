<?php

namespace Epush\Auth\User\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SignupDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL|string',
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL|email',
            'phone' => 'required|unique:users,phone,NULL,id,deleted_at,NULL|string|regex:/^\d{10,16}$/',
            'address' => 'required|string',
            'enabled' => 'boolean',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',
            'role' => 'exists:roles,name',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        return $this->data;
    }

    public function toTableArray(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';

        return subAssociativeArray([

            'first_name',
            'last_name',
            'username',
            'password',
            'email',
            'phone',
            'address',
            'enabled',
            'avatar',

        ], $this->data);
    }

    public function getRole(): string
    {
        return $this->data['role'] ?? '';
    }
}