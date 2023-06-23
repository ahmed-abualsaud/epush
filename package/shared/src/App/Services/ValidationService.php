<?php

namespace Epush\Shared\App\Services;

use Epush\Shared\Domain\Contract\DtoContract;
use Epush\Shared\Infra\Exception\ExceptionContract;
use Epush\Shared\App\Contracts\ValidationServiceContract;
use Epush\Shared\Infra\Validator\ValidationDriverContract;

class ValidationService implements ValidationServiceContract
{
    public function __construct(protected ValidationDriverContract $validationDriver) {}


    public function validate(DtoContract $input, array $rules): void
    {
        $this->validationDriver->validate($input, $rules);
        if ($this->validationDriver->fails()) {
            throw $this->validationDriver->exception();
        }
    }

    public function fails(): bool
    {
        return $this->validationDriver->fails();
    }

    public function exception(): ExceptionContract
    {
        return $this->validationDriver->exception();
    }
}