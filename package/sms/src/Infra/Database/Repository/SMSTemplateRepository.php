<?php

namespace Epush\SMS\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\SMS\Infra\Database\Model\SMSTemplate;
use Epush\SMS\Infra\Database\Repository\Contract\SMSTemplateRepositoryContract;

class SMSTemplateRepository implements SMSTemplateRepositoryContract
{
    public function __construct(

        private SMSTemplate $template
        
    ) {}

    public function all(string|null $userID): array
    {
        return DB::transaction(function () use ($userID) {

            if (empty($userID)) {
                return $this->template->all()->toArray();
            }

            return $this->template->where('user_id', $userID)->get()->toArray();
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