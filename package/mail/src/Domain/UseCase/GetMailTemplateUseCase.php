<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\Domain\DTO\MailTemplateDto;
use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMailTemplateUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MailTemplateDto $mailTemplateDto): array
    {
        $this->validationService->validate($mailTemplateDto->toArray(), MailTemplateDto::rules());
        return $this->mailService->getMailTemplate($mailTemplateDto->getMailTemplateID());
    }
}