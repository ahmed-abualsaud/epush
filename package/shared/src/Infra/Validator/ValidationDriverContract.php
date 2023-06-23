<?php

namespace Epush\Shared\Infra\Validator;

use Illuminate\Support\MessageBag;
use Epush\Shared\Domain\Contract\DtoContract;
use Epush\Shared\Infra\Exception\ExceptionContract;

interface ValidationDriverContract
{
    public function validate(DtoContract $input, array $rules): void;
    public function fails(): bool;
    public function errors(): MessageBag;
    public function exception(): ExceptionContract;
}