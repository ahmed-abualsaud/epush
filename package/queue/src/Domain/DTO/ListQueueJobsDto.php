<?php

namespace Epush\Queue\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ListQueueJobsDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'queue' => 'string',
            'take' => 'integer',
            'page' => 'integer'
        ];
    }

    public function getQueueName(): string
    {
        return $this->data['queue'];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getPageSize(): string
    {
        return (int) ($this->data['take'] ?? 0);
    }
}