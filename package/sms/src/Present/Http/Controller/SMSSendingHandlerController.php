<?php

namespace Epush\SMS\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\SMS\Domain\DTO\SMSSendingHandlerDto;
use Epush\SMS\Domain\DTO\AddSMSSendingHandlerDto;
use Epush\SMS\Domain\DTO\ListSMSSendingHandlersDto;
use Epush\SMS\Domain\DTO\SearchSMSSendingHandlerDto;
use Epush\SMS\Domain\DTO\UpdateSMSSendingHandlerDto;

use Epush\SMS\Domain\UseCase\AddSMSSendingHandlerUseCase;
use Epush\SMS\Domain\UseCase\GetSMSSendingHandlerUseCase;
use Epush\SMS\Domain\UseCase\ListSMSSendingHandlersUseCase;
use Epush\SMS\Domain\UseCase\DeleteSMSSendingHandlerUseCase;
use Epush\SMS\Domain\UseCase\SearchSMSSendingHandlerUseCase;
use Epush\SMS\Domain\UseCase\UpdateSMSSendingHandlerUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/sms')]
class SMSSendingHandlerController
{
    #[Get('sending-handler')]
    public function listSMSSendingHandlers(ListSMSSendingHandlersDto $listSMSSendingHandlersDto, ListSMSSendingHandlersUseCase $listSMSSendingHandlersUseCase): Response
    {
        return jsonResponse($listSMSSendingHandlersUseCase->execute($listSMSSendingHandlersDto));
    }

    #[Post('sending-handler')]
    public function addSMSSendingHandler(AddSMSSendingHandlerDto $addSMSSendingHandlerDto, AddSMSSendingHandlerUseCase $addSMSSendingHandlerUseCase): Response
    {
        return jsonResponse($addSMSSendingHandlerUseCase->execute($addSMSSendingHandlerDto));
    }

    #[Get('sending-handler/{sms_sending_handler_id}')]
    public function getSMSSendingHandler(SMSSendingHandlerDto $smsSendingHandlerDto, GetSMSSendingHandlerUseCase $getSMSSendingHandlerUseCase): Response
    {
        return jsonResponse($getSMSSendingHandlerUseCase->execute($smsSendingHandlerDto));
    }

    #[Put('sending-handler/{sms_sending_handler_id}')]
    public function updateSMSSendingHandler(SMSSendingHandlerDto $smsSendingHandlerDto, UpdateSMSSendingHandlerDto $updateSMSSendingHandlerDto, UpdateSMSSendingHandlerUseCase $updateSMSSendingHandlerUseCase): Response
    {
        return jsonResponse($updateSMSSendingHandlerUseCase->execute($smsSendingHandlerDto, $updateSMSSendingHandlerDto));
    }

    #[Delete('sending-handler/{sms_sending_handler_id}')]
    public function deleteSMSSendingHandler(SMSSendingHandlerDto $smsSendingHandlerDto, DeleteSMSSendingHandlerUseCase $deleteSMSSendingHandlerUseCase): Response
    {
        return jsonResponse($deleteSMSSendingHandlerUseCase->execute($smsSendingHandlerDto));
    }

    #[Post('sending-handler/search')]
    public function searchSMSSendingHandlerColumn(SearchSMSSendingHandlerDto $searchSMSSendingHandlerDto, SearchSMSSendingHandlerUseCase $searchSMSSendingHandlerUseCase): Response
    {
        return jsonResponse($searchSMSSendingHandlerUseCase->execute($searchSMSSendingHandlerDto));
    }
}