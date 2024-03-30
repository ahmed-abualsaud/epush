<?php

namespace Epush\Core\Message\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Core\Message\Domain\DTO\SendMessageDto;
use Epush\Core\Message\Domain\DTO\OldApiSendBulkDto;
use Epush\Core\Message\Domain\DTO\OldApiCheckBalanceDto;

use Epush\Core\Message\Domain\UseCase\SendMessageUseCase;
use Epush\Core\Message\Domain\UseCase\OldApiSendBulkUseCase;
use Epush\Core\Message\Domain\UseCase\OldApiCheckBalanceUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api')]
class MessageApiController
{
    #[Post('message/send')]
    public function sendMessage(SendMessageDto $sendMessageDto, SendMessageUseCase $sendMessageUseCase): Response
    {
        return jsonResponse($sendMessageUseCase->execute($sendMessageDto));
    }

    #[Get('v2/send_bulk')]
    public function sendBulkGet(OldApiSendBulkDto $oldApiSendBulkDto, OldApiSendBulkUseCase $oldApiSendBulkUseCase): mixed
    {
        return response()->json($oldApiSendBulkUseCase->execute($oldApiSendBulkDto), 400);
    }

    #[Post('v2/send_bulk')]
    public function sendBulkPost(OldApiSendBulkDto $oldApiSendBulkDto, OldApiSendBulkUseCase $oldApiSendBulkUseCase): mixed
    {
        return response()->json($oldApiSendBulkUseCase->execute($oldApiSendBulkDto), 400);
    }

    #[Get('v2/check_balance')]
    public function checkBalance(OldApiCheckBalanceDto $oldApiCheckBalanceDto, OldApiCheckBalanceUseCase $oldApiCheckBalanceUseCase): mixed
    {
        return response()->json($oldApiCheckBalanceUseCase->execute($oldApiCheckBalanceDto), 400);
    }
}