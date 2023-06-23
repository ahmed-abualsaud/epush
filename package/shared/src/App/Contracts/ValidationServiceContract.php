<?php

namespace Epush\Shared\App\Contracts;

use Epush\Shared\Domain\Contract\DtoContract;
use Epush\Shared\Infra\Exception\ExceptionContract;

interface ValidationServiceContract {

    public function validate(DtoContract $input, array $rules): void;

    public function fails(): bool;

    public function exception(): ExceptionContract;
}