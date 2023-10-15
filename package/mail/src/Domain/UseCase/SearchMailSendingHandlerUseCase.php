<?php

namespace Epush\Mail\Domain\UseCase;

use Epush\Mail\App\Contract\MailServiceContract;
use Epush\Mail\Domain\DTO\SearchMailSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMailSendingHandlerUseCase
{
    public function __construct(

        private MailServiceContract $mailSendingHandlerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMailSendingHandlerDto $searchMailSendingHandlerDto): array
    {
        $this->validationService->validate($searchMailSendingHandlerDto->toArray(), SearchMailSendingHandlerDto::rules());
        return $this->mailSendingHandlerService->searchMailSendingHandlerColumn(
            $searchMailSendingHandlerDto->getSearchColumn(),
            $searchMailSendingHandlerDto->getSearchValue(),
            $searchMailSendingHandlerDto->getPageSize()
        );
    }
}