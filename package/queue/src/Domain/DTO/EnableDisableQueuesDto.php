<?php

namespace Epush\Queue\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class EnableDisableQueuesDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'enabled' => 'required|boolean',
            'queues' => 'required|array',
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['enabled']) && $this->data['enabled'] = $this->data['enabled'] == 'true';
        return $this->data;
    }

    public function enabled(): bool
    {
        return $this->data['enabled'] ?? '';
    }

    public function getQueuesName(): array
    {
        return $this->data['queues'];
    }
}