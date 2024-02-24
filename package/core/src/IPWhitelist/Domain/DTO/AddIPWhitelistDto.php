<?php

namespace Epush\Core\IPWhitelist\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddIPWhitelistDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'ip_address' => 'required|ip',
            'allowed' => 'boolean',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['allowed']) && $this->data['allowed'] = $this->data['allowed'] == 'true';
        return $this->data;
    }
}