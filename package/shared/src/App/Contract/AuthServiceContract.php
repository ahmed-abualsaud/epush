<?php

namespace Epush\Shared\App\Contract;

interface AuthServiceContract
{
    public function getUser(string $userID): array;
}