<?php

namespace Epush\Queue\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class CheckQueueEnabledDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'queue' => 'required|string',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getQueueName(): string
    {
        return $this->data['queue'];
    }
}