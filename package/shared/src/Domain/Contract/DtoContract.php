<?php

namespace Epush\Shared\Domain\Contract;

interface DtoContract
{
    public function toArray();
    public static function rules();
}