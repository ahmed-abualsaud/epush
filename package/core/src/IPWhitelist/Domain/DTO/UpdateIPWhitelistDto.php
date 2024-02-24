<?php

namespace Epush\Core\IPWhitelist\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateIPWhitelistDto implements DtoContract
{
    private static string $ipwhitelistID;

    public function __construct(string $ipwhitelistID, private array $data) 
    {
        self::$ipwhitelistID = $ipwhitelistID;
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'ip_address' => 'ip',
            'allowed' => 'boolean',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}