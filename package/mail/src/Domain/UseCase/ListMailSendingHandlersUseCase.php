<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Mail\Domain\DTO\ListMailSendingHandlersDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMailSendingHandlersUseCase
{
    public function __construct(

        private MailServiceContract $MailService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMailSendingHandlersDto $listMailSendingHandlersDto): array
    {
        $this->validationService->validate($listMailSendingHandlersDto->toArray(), ListMailSendingHandlersDto::rules());
        return $this->MailService->listMailSendingHandlers($listMailSendingHandlersDto->getPageSize());
    }
}