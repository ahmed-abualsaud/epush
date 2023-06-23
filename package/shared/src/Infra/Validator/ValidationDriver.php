<?php

namespace Epush\Shared\Infra\Validator;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Epush\Shared\Domain\Contract\DtoContract;
use Epush\Shared\Infra\Exception\ExceptionContract;

class ValidationDriver implements ValidationDriverContract
{
    private $validator;

    public function validate(DtoContract $input, array $rules): void
    {
        $this->validator = Validator::make($input->toArray(), $rules);
    }

    public function fails(): bool
    {
        return $this->validator->fails();
    }

    public function errors(): MessageBag
    {
        return $this->validator->errors();
    }

    public function exception(): ExceptionContract
    {
        return new ValidationException($this->validator);
    }
}