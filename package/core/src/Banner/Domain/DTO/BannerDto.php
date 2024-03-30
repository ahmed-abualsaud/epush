<?php

namespace Epush\Core\Banner\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class BannerDto implements DtoContract
{
    public function __construct(private array $data) {}

    public static function rules(): array
    {
        return [
            'banner_id' => 'exists:banners,id'
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function getBannerID(): string
    {
        return $this->data['banner_id']?? '';
    }
}