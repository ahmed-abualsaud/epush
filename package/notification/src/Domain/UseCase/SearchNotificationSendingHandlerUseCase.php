<?php

namespace Epush\Notification\Domain\UseCase;

use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Notification\Domain\DTO\SearchNotificationSendingHandlerDto;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchNotificationSendingHandlerUseCase
{
    public function __construct(

        private NotificationServiceContract $notificationSendingHandlerService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchNotificationSendingHandlerDto $searchNotificationSendingHandlerDto): array
    {
        $this->validationService->validate($searchNotificationSendingHandlerDto->toArray(), SearchNotificationSendingHandlerDto::rules());
        return $this->notificationSendingHandlerService->searchNotificationSendingHandlerColumn(
            $searchNotificationSendingHandlerDto->getSearchColumn(),
            $searchNotificationSendingHandlerDto->getSearchValue(),
            $searchNotificationSendingHandlerDto->getPageSize()
        );
    }
}