<?php

namespace Epush\Auth\User\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateUserDto implements DtoContract
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
            'phone' => 'unique:users,phone,'.self::$userID.',id,deleted_at,NULL|string|regex:/^\d{3}-?\d{3}-?\d{5}$/',
            'religion' => 'string',
            'enabled' => 'boolean',
            'notes' => 'string',
            'avatar' => 'image|mimes:jpeg,jpg,png|max:1024',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        return subAssociativeArray([

            'first_name',
            'last_name',
            'username',
            'email',
            'phone',
            'religion',
            'enabled',
            'notes',
            'avatar',
            'password',
            'password_confirmation',

        ], $this->data);
    }

    public function getData(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        return subAssociativeArray([

            'first_name',
            'last_name',
            'username',
            'email',
            'phone',
            'religion',
            'enabled',
            'notes',
            'avatar',
            'password'

        ], $this->data);
    }
}