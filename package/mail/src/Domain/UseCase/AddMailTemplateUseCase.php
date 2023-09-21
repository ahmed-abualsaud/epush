<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\Domain\DTO\AddMailTemplateDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Mail\App\Contract\MailServiceContract;

class AddMailTemplateUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMailTemplateDto $addMailTemplateDto): array
    {
        $this->validationService->validate($addMailTemplateDto->toArray(), AddMailTemplateDto::rules());
        return $this->mailService->addMailTemplate($addMailTemplateDto->toArray());
    }
}