<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\Domain\DTO\MailTemplateDto;
use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class DeleteMailTemplateUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MailTemplateDto $mailTemplateDto): bool
    {
        $this->validationService->validate($mailTemplateDto->toArray(), MailTemplateDto::rules());
        return $this->mailService->deleteMailTemplate($mailTemplateDto->getMailTemplateID());
    }
}