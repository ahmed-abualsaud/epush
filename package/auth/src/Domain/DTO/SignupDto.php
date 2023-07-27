<?php

namespace Epush\Auth\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SignupDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'unique:users,username,NULL,id,deleted_at,NULL|required|string',
            'password' => 'string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'email' => 'unique:users,email,NULL,id,deleted_at,NULL|required|email',
            'phone' => 'unique:users,phone,NULL,id,deleted_at,NULL|required|string|regex:/^\d{10,16}$/',
            'religion' => 'required|string',
            'enabled' => 'boolean',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',
            'notes' => 'string',
            'role' => 'exists:roles,name'
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
        $this->data['password'] = $this->data['password'] ?? '';

        return subAssociativeArray([

            'first_name',
            'last_name',
            'username',
            'password',
            'email',
            'phone',
            'religion',
            'enabled',
            'notes',
            'avatar',

        ], $this->data);
    }

    public function getRole(): string
    {
        return $this->data['role'] ?? '';
    }
}