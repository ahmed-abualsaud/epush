<?php

namespace Epush\Core\MessageReport\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateMessageReportDto implements DtoContract
{
    private static string $messageID;

    public function __construct(string $messageID, private array $data) 
    {
        self::$messageID = $messageID;
    }

    public static function rules(): array
    {
        return [
            'valid' => 'numeric',
            'unknown' => 'numeric',
            'inactive' => 'numeric',
            'doublication' => 'numeric',
            'operators' => 'array'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}