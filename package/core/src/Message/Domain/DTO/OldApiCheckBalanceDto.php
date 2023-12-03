<?php

namespace Epush\Core\Message\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class OldApiCheckBalanceDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'username' => 'required|string|exists:users',
            'password' => 'required|string',
            'api_key' => 'required|string|exists:clients',
        ];
    }

    public function toArray(): array
    {
        return subAssociativeArray([

            'username',
            'password',
            'api_key',
            'ip_address',

        ], $this->data);
    }
}