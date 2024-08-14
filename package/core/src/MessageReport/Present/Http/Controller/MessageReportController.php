<?php

namespace Epush\Core\MessageReport\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\MessageReport\Domain\DTO\MessageReportDto;
use Epush\Core\MessageReport\Domain\DTO\AddMessageReportDto;
use Epush\Core\MessageReport\Domain\DTO\ListMessageReportsDto;
use Epush\Core\MessageReport\Domain\DTO\SearchMessageReportDto;
use Epush\Core\MessageReport\Domain\DTO\UpdateMessageReportDto;

use Epush\Core\MessageReport\Domain\UseCase\GetMessageReportUseCase;
use Epush\Core\MessageReport\Domain\UseCase\AddMessageReportUseCase;
use Epush\Core\MessageReport\Domain\UseCase\ListMessageReportsUseCase;
use Epush\Core\MessageReport\Domain\UseCase\DeleteMessageReportUseCase;
use Epush\Core\MessageReport\Domain\UseCase\SearchMessageReportUseCase;
use Epush\Core\MessageReport\Domain\UseCase\UpdateMessageReportUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message-report')]
class MessageReportController
{
    #[Get('/')]
    public function listMessageReports(ListMessageReportsDto $listMessageReportsDto, ListMessageReportsUseCase $listMessageReportsUseCase): Response
    {
        return jsonResponse($listMessageReportsUseCase->execute($listMessageReportsDto));
    }

    #[Post('/')]
    public function addMessageReport(AddMessageReportDto $addMessageReportDto, AddMessageReportUseCase $addMessageReportUseCase): Response
    {
        return jsonResponse($addMessageReportUseCase->execute($addMessageReportDto));
    }

    #[Get('{message_id}')]
    public function getMessageReport(MessageReportDto $messageReportDto, GetMessageReportUseCase $getMessageReportUseCase): Response
    {
        return jsonResponse($getMessageReportUseCase->execute($messageReportDto));
    }

    #[Put('{message_id}')]
    public function updateMessageReport(MessageReportDto $messageReportDto, UpdateMessageReportDto $updateMessageReportDto, UpdateMessageReportUseCase $updateMessageReportUseCase): Response
    {
        return jsonResponse($updateMessageReportUseCase->execute($messageReportDto, $updateMessageReportDto));
    }

    #[Delete('{message_id}')]
    public function deleteMessageReport(MessageReportDto $messageReportDto, DeleteMessageReportUseCase $deleteMessageReportUseCase): Response
    {
        return jsonResponse($deleteMessageReportUseCase->execute($messageReportDto));
    }

    #[Post('/search')]
    public function searchMessageReportColumn(SearchMessageReportDto $searchMessageReportDto, SearchMessageReportUseCase $searchMessageReportUseCase): Response
    {
        return jsonResponse($searchMessageReportUseCase->execute($searchMessageReportDto));
    }
}