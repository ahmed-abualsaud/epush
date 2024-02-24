<?php

namespace Epush\SMS\Infra\Database\Repository\Contract;

interface SMSTemplateRepositoryContract
{
    public function all(string|null $userID): array;

    public function get(string $templateID): array;

    public function create(array $template): array;

    public function update(string $templateID, array $template): array;

    public function delete(string $templateID): bool;
}