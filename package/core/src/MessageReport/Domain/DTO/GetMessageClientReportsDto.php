<?php

namespace Epush\Core\MessageReport\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class GetMessageClientReportsDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'exists:users,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getUserID(): string
    {
        return (int) ($this->data['user_id'] ?? '');
    }
}