<?php

namespace Epush\Mail\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Mail\Infra\Database\Model\MailTemplate;
use Epush\Mail\Infra\Database\Repository\Contract\MailTemplateRepositoryContract;

class MailTemplateRepository implements MailTemplateRepositoryContract
{
    public function __construct(

        private MailTemplate $template
        
    ) {}

    public function all(): array
    {
        return DB::transaction(function () {

            return $this->template->all()->toArray();

        });
    }

    public function get(string $templateID): array
    {
        return DB::transaction(function () use ($templateID) {

            $template =  $this->template->where('id', $templateID)->first();
            return empty($template) ? [] : $template->toArray();

        });
    }
    
    public function create(array $template): array
    {
        return DB::transaction(function () use ($template) {

            return $this->template->create($template)->toArray();

        });
    }

    public function update(string $templateID, array $data): array
    {
        return DB::transaction(function () use ($templateID, $data) {

            $template = $this->template->where('id', $templateID)->firstOrFail();

            if (! empty($data)) {
                $template->update($data);
            }

            return $template->toArray();

        });
    }

    public function delete(string $templateID): bool
    {
        return DB::transaction(function () use ($templateID) {

            return $this->template->where('id', $templateID)->delete();

        }); 
    }
}