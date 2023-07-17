<?php

namespace Epush\Auth\App\Contract;

interface UserServiceContract
{
    public function list(int $take): array;

    public function signup(array $data, string $roleName): void;
}