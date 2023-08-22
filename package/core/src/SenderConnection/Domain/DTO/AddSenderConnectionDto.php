<?php

namespace Epush\Core\SenderConnection\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddSenderConnectionDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'sender_id' => 'required|string|exists:senders,id',
            'smsc_id' => 'required|string|exists:smscs,id',
            'approved' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        ! empty($this->data['approved']) && $this->data['approved'] = $this->data['approved'] == 'true';
        return $this->data;
    }
}