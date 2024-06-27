<?php

namespace Epush\Core\Client\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddClientDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL|string',
            'password' => 'string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/|confirmed',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL|email',
            'phone' => 'required|unique:users,phone,NULL,id,deleted_at,NULL|string|regex:/^\d{10,16}$/',
            'religion' => 'required|string',
            'address' => 'required|string',
            'enabled' => 'boolean',
            'company_name' => 'required|unique:clients,company_name,NULL,id,deleted_at,NULL|string',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',
            'notes' => 'string',
            'sales_id' => 'required|exists:sales,id',
            'partner_id' => 'exists:users,id',
            'business_field_id' => 'required|exists:business_fields,id'
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
            'sales_id',
            'partner_id',
            'business_field_id'

        ], $this->data);
    }

    public function getUser(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        $this->data['password'] = $this->data['password'] ?? '';
        $this->data['username'] = $this->data['username'] . (stringContains($this->data['username'], '@epushagency') ? '' : '@epushagency');

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
}