<?php

namespace Epush\Auth\App\Contract;

interface UserServiceContract
{
    public function signup(array $data, string $roleName): void;
}