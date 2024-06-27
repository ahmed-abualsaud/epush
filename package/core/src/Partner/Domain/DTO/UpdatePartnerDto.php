<?php

namespace Epush\Core\Partner\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdatePartnerDto implements DtoContract
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
            'password' => 'string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/|confirmed',
            'email' => 'unique:users,email,'.self::$userID.',id,deleted_at,NULL|email',
            'phone' => 'unique:users,phone,'.self::$userID.',id,deleted_at,NULL|string|regex:/^\d{10,16}$/',
            'address' => 'string',
            'enabled' => 'boolean',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',

        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        return $this->data;
    }

    public function getPartner(): array
    {
        return subAssociativeArray([


        ], $this->data);
    }

    public function getUser(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        ! empty($this->data['username']) && $this->data['username'] = $this->data['username'] . (stringContains($this->data['username'], '@epushagency') ? '' : '@epushagency');

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