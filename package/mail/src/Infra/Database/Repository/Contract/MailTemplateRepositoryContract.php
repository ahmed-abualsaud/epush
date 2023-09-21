<?php

namespace Epush\Mail\Infra\Database\Repository\Contract;

interface MailTemplateRepositoryContract
{
    public function all(): array;

    public function get(string $templateID): array;

    public function create(array $template): array;

    public function update(string $templateID, array $template): array;

    public function delete(string $templateID): bool;
}