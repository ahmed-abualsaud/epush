<?php

namespace Epush\Core\Client\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateClientDto implements DtoContract
{
    private static string $userID;

    public function __construct(string $userID, private array $data) 
    {
        self::$userID = $userID;
    }

    public static function rules(): array
    {
        return [

            'first_name' => 'string',
            'last_name' => 'string',
            'username' => 'unique:users,username,'.self::$userID.',id,deleted_at,NULL|string',
            'password' => 'string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'email' => 'unique:users,email,'.self::$userID.',id,deleted_at,NULL|email',
            'phone' => 'unique:users,phone,'.self::$userID.',id,deleted_at,NULL|string|regex:/^\d{10,16}$/',
            'religion' => 'string',
            'address' => 'string',
            'enabled' => 'boolean',
            'company_name' => 'unique:clients,company_name,'.self::$userID.',user_id|string',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',
            'notes' => 'string',
            'sync_websites' => 'boolean',
            'sales_id' => 'exists:sales,id',
            'business_field_id' => 'exists:business_fields,id',
            'api_key' => 'string|unique:clients,api_key,'.self::$userID.',id,deleted_at,NULL',
            'use_api_key' => 'boolean',
            'ip_address' => 'string',
            'use_ip_address' => 'boolean',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        ! empty($this->data['use_api_key']) && $this->data['use_api_key'] = $this->data['use_api_key'] == 'true';
        ! empty($this->data['use_ip_address']) && $this->data['use_ip_address'] = $this->data['use_ip_address'] == 'true';
        ! empty($this->data['sync_websites']) && $this->data['sync_websites'] = $this->data['sync_websites'] == 'true';
        return $this->data;
    }

    public function getClient(): array
    {
        ! empty($this->data['use_api_key']) && $this->data['use_api_key'] = $this->data['use_api_key'] == 'true';
        ! empty($this->data['use_ip_address']) && $this->data['use_ip_address'] = $this->data['use_ip_address'] == 'true';

        return subAssociativeArray([

            'company_name',
            'religion',
            'notes',
            'websites',
            'sync_websites',
            'sales_id',
            'business_field_id',
            'api_key',
            'use_api_key',
            'ip_address',
            'use_ip_address',
            'address',

        ], $this->data);
    }

    public function getUser(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        ! empty($this->data['sync_websites']) && $this->data['sync_websites'] = $this->data['sync_websites'] == 'true';
        ! empty($this->data['username']) && $this->data['username'] = $this->data['username'] . (stringContains($this->data['username'], '@epushagency.com') ? '' : '@epushagency.com');

        return subAssociativeArray([

            'first_name',
            'last_name',
            'username',
            'password',
            'email',
            'address',
            'phone',
            'enabled',
            'avatar',

        ], $this->data);
    }
}