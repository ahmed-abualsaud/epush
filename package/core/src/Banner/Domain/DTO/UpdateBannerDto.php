<?php

namespace Epush\Core\Banner\Domain\DTO;

use Epush\Shared\Domain\Contract\DtoContract;

class UpdateBannerDto implements DtoContract
{
    private static string $bannerID;

    public function __construct(string $bannerID, private array $data) 
    {
        self::$bannerID = $bannerID;
    }

    public static function rules(): array
    {
        return [
            'image' => 'image|mimes:jpeg,jpg,png|max:1024',
        ];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}