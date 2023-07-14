<?php

namespace Epush\Orchi\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class HandleGroupDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'handle_group_id' => 'exists:handle_groups,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getHandleGroupID(): string
    {
        return $this->data['handle_group_id']?? '';
    }
}