<?php

namespace Epush\Queue\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class CheckQueuesEnabledDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'queues' => 'required|array',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getQueuesName(): array
    {
        return $this->data['queues'];
    }
}