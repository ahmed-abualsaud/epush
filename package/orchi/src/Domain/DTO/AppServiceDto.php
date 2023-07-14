<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AppServiceDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'service_id' => 'exists:app_services,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getServiceID(): string
    {
        return $this->data['service_id']?? '';
    }
}