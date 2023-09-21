<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\Domain\DTO\AddMailSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;
use Epush\Mail\App\Contract\MailServiceContract;

class AddMailSendingHandlerUseCase
{
    public function __construct(

        private MailServiceContract $mailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(AddMailSendingHandlerDto $addMailSendingHandlerDto): array
    {
        $this->validationService->validate($addMailSendingHandlerDto->toArray(), AddMailSendingHandlerDto::rules());
        return $this->mailService->addMailSendingHandler($addMailSendingHandlerDto->toArray());
    }
}