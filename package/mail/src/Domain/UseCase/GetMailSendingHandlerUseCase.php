<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\Domain\DTO\MailSendingHandlerDto;
use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class GetMailSendingHandlerUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(MailSendingHandlerDto $mailSendingHandlerDto): array
    {
        $this->validationService->validate($mailSendingHandlerDto->toArray(), MailSendingHandlerDto::rules());
        return $this->mailService->getMailSendingHandler($mailSendingHandlerDto->getMailSendingHandlerID());
    }
}