<?php

namespace Epush\Core\Domain\DTO;

class AddClientDto
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'unique:client,username,NULL,id,deleted_at,NULL|required|string',
            'password' => 'string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'email' => 'unique:client,email,NULL,id,deleted_at,NULL|required|email',
            'phone' => 'unique:client,phone,NULL,id,deleted_at,NULL|required|string|regex:/^\d{10,16}$/',
            'religion' => 'required|string',
            'address' => 'required|string',
            'enabled' => 'boolean',
            'company_name' => 'required|unique:clients|string',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',
            'notes' => 'string',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        return $this->data;
    }

    public function getClient(): array
    {
        return subAssociativeArray([

            'company_name',
            'religion',
            'notes',
            'websites',
            'address'

        ], $this->data);
    }

    public function getUser(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        $this->data['password'] = $this->data['password'] ?? '';

        $this->data['username'] = $this->data['username'] . '@epushagency.com';
        return subAssociativeArray([

            'first_name',
            'last_name',
            'username',
            'password',
            'email',
            'phone',
            'enabled',
            'avatar',

        ], $this->data);
    }
}