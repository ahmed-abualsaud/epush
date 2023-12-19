<?php

namespace Epush\Queue\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class EnableDisableQueueDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'enabled' => 'required|boolean',
            'queue' => 'required|string',
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

    public function getQueueName(): string
    {
        return $this->data['queue'];
    }
}