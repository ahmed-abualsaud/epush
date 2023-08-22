<?php

namespace Epush\Core\Sender\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSenderDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'user_id' => 'required|string|exists:clients,user_id',
            'name' => 'required|string',
            'approved' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['approved']) && $this->data['approved'] = $this->data['approved'] == 'true';
        return $this->data;
    }
}