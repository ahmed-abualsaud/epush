<?php

namespace Epush\Core\IPWhitelist\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class IPWhitelistDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'ipwhitelist_id' => 'exists:ip_whitelists,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getIPWhitelistID(): string
    {
        return $this->data['ipwhitelist_id']?? '';
    }
}