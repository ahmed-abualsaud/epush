<?php

namespace Epush\Expense\Order\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class ListOrdersDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'take' => 'integer',
            'page' => 'integer',
            'partner_id' => 'exists:users,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getPageSize(): string
    {
        return (int) ($this->data['take'] ?? 0);
    }

    public function getPartnerID(): string
    {
        return (int) ($this->data['partner_id'] ?? null);
    }
}