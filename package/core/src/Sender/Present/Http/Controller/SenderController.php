<?php

namespace Epush\Core\Sender\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Sender\Domain\DTO\SenderDto;
use Epush\Core\Sender\Domain\DTO\AddSenderDto;
use Epush\Core\Sender\Domain\DTO\ListSendersDto;
use Epush\Core\Sender\Domain\DTO\SearchSenderDto;
use Epush\Core\Sender\Domain\DTO\UpdateSenderDto;

use Epush\Core\Sender\Domain\UseCase\GetSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\AddSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\ListSendersUseCase;
use Epush\Core\Sender\Domain\UseCase\DeleteSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\SearchSenderUseCase;
use Epush\Core\Sender\Domain\UseCase\UpdateSenderUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/sender')]
class SenderController
{
    #[Get('/')]
    public function listSenders(ListSendersDto $listSendersDto, ListSendersUseCase $listSendersUseCase): Response
    {
        return jsonResponse($listSendersUseCase->execute($listSendersDto));
    }

    #[Post('/')]
    public function addSender(AddSenderDto $addSenderDto, AddSenderUseCase $addSenderUseCase): Response
    {
        return jsonResponse($addSenderUseCase->execute($addSenderDto));
    }

    #[Get('{sender_id}')]
    public function getSender(SenderDto $senderDto, GetSenderUseCase $getSenderUseCase): Response
    {
        return jsonResponse($getSenderUseCase->execute($senderDto));
    }

    #[Put('{sender_id}')]
    public function updateSender(SenderDto $senderDto, UpdateSenderDto $updateSenderDto, UpdateSenderUseCase $updateSenderUseCase): Response
    {
        return jsonResponse($updateSenderUseCase->execute($senderDto, $updateSenderDto));
    }

    #[Delete('{sender_id}')]
    public function deleteSender(SenderDto $senderDto, DeleteSenderUseCase $deleteSenderUseCase): Response
    {
        return jsonResponse($deleteSenderUseCase->execute($senderDto));
    }

    #[Post('search')]
    public function searchSenderColumn(SearchSenderDto $searchSenderDto, SearchSenderUseCase $searchSenderUseCase): Response
    {
        return jsonResponse($searchSenderUseCase->execute($searchSenderDto));
    }
}