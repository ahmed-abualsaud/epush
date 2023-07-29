<?php

namespace Epush\Core\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ClientDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'client_id' => 'exists:clients,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getClientID(): string
    {
        return $this->data['client_id']?? '';
    }
}