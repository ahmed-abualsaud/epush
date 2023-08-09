<?php

namespace Epush\Core\Client\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class SearchClientDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'take' => 'integer',
            'page' => 'integer',
            'column' => 'required',
            'value' => 'required',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getSearchColumn(): string
    {
        return $this->data['column'];
    }

    public function getSearchValue(): string
    {
        return in_array(strtolower($this->data['value']), ["true", "yes", "1"]) ? true : $this->data['value'];
    }

    public function getPageSize(): string
    {
        return (int) ($this->data['take'] ?? 0);
    }

    public function searchClient(): bool
    {
        return in_array($this->data['column'], [

            'company_name',
            'religion',
            'notes',
            'websites',
            'created_at',

        ]);
    }
}