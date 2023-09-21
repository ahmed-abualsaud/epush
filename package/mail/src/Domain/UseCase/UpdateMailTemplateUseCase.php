<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Mail\Domain\DTO\MailTemplateDto;
use Epush\Mail\Domain\DTO\UpdateMailTemplateDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class UpdateMailTemplateUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MailTemplateDto $mailTemplateDto, UpdateMailTemplateDto $updateMailTemplateDto): array
    {
        $this->validationService->validate($mailTemplateDto->toArray(), MailTemplateDto::rules());
        $this->validationService->validate($updateMailTemplateDto->toArray(), UpdateMailTemplateDto::rules());
        return $this->mailService->updateMailTemplate($mailTemplateDto->getMailTemplateID(), $updateMailTemplateDto->toArray());
    }
}