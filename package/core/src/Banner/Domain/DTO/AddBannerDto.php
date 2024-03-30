<?php

namespace Epush\Core\Banner\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class AddBannerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:10000',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}