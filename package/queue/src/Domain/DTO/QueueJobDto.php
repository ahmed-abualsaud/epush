<?php

namespace Epush\Queue\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class QueueJobDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'queue_id' => 'exists:jobs,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getQueueID(): string
    {
        return $this->data['queue_id']?? '';
    }
}