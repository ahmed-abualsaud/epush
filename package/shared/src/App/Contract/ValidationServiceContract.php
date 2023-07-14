<?php

namespace Epush\Shared\App\Contract;

use Epush\Shared\Infra\Exception\ExceptionContract;

interface ValidationServiceContract {

    public function validate(array $input, array $rules): void;

    public function fails(): bool;

    public function exception(): ExceptionContract;
}