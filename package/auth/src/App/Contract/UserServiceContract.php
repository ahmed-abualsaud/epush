<?php

namespace Epush\Auth\App\Contract;

interface UserServiceContract
{
    public function get(string $userID): array;

    public function list(int $take): array;

    public function update(string $userID ,array $data): array;

    public function signup(array $data, string $roleName = null): array;

    public function delete(string $userID): bool;

    public function checkUserEnabledOrFail(string $userName): bool;
}