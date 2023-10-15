<?php

namespace Epush\Shared\Infra\InterprocessCommunication\Microprocess;

use Epush\Notification\App\Contract\NotificationServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\MicroprocessContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class SendNotificationMicroprocess implements MicroprocessContract
{
    public function __construct(

        private NotificationServiceContract $notificationService

    ) {}

    public function listen(InterprocessCommunicationEngineContract $engine, string $event = null, mixed ...$data): mixed
    {
        [$handler, $request, $response] = $data;
        return $this->notificationService->checkAndSendNotification($handler, $request, $response);
    }
}