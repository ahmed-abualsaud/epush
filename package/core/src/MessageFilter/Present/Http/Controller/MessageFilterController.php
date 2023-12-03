<?php

namespace Epush\Core\MessageFilter\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\MessageFilter\Domain\DTO\MessageFilterDto;
use Epush\Core\MessageFilter\Domain\DTO\AddMessageFilterDto;
use Epush\Core\MessageFilter\Domain\DTO\ListMessageFiltersDto;
use Epush\Core\MessageFilter\Domain\DTO\SearchMessageFilterDto;
use Epush\Core\MessageFilter\Domain\DTO\UpdateMessageFilterDto;

use Epush\Core\MessageFilter\Domain\UseCase\GetMessageFilterUseCase;
use Epush\Core\MessageFilter\Domain\UseCase\AddMessageFilterUseCase;
use Epush\Core\MessageFilter\Domain\UseCase\ListMessageFiltersUseCase;
use Epush\Core\MessageFilter\Domain\UseCase\DeleteMessageFilterUseCase;
use Epush\Core\MessageFilter\Domain\UseCase\SearchMessageFilterUseCase;
use Epush\Core\MessageFilter\Domain\UseCase\UpdateMessageFilterUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message-filter')]
class MessageFilterController
{
    #[Get('/')]
    public function listMessageFilters(ListMessageFiltersDto $listMessageFiltersDto, ListMessageFiltersUseCase $listMessageFiltersUseCase): Response
    {
        return jsonResponse($listMessageFiltersUseCase->execute($listMessageFiltersDto));
    }

    #[Post('/')]
    public function addMessageFilter(AddMessageFilterDto $addMessageFilterDto, AddMessageFilterUseCase $addMessageFilterUseCase): Response
    {
        return jsonResponse($addMessageFilterUseCase->execute($addMessageFilterDto));
    }

    #[Get('{message_filter_id}')]
    public function getMessageFilter(MessageFilterDto $messagefilterDto, GetMessageFilterUseCase $getMessageFilterUseCase): Response
    {
        return jsonResponse($getMessageFilterUseCase->execute($messagefilterDto));
    }

    #[Put('{message_filter_id}')]
    public function updateMessageFilter(MessageFilterDto $messagefilterDto, UpdateMessageFilterDto $updateMessageFilterDto, UpdateMessageFilterUseCase $updateMessageFilterUseCase): Response
    {
        return jsonResponse($updateMessageFilterUseCase->execute($messagefilterDto, $updateMessageFilterDto));
    }

    #[Delete('{message_filter_id}')]
    public function deleteMessageFilter(MessageFilterDto $messagefilterDto, DeleteMessageFilterUseCase $deleteMessageFilterUseCase): Response
    {
        return jsonResponse($deleteMessageFilterUseCase->execute($messagefilterDto));
    }

    #[Post('/search')]
    public function searchMessageFilterColumn(SearchMessageFilterDto $searchMessageFilterDto, SearchMessageFilterUseCase $searchMessageFilterUseCase): Response
    {
        return jsonResponse($searchMessageFilterUseCase->execute($searchMessageFilterDto));
    }
}