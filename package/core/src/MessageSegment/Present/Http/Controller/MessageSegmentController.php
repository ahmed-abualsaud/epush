<?php

namespace Epush\Core\MessageSegment\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Core\MessageSegment\Domain\DTO\ListMessageSegmentsDto;
use Epush\Core\MessageSegment\Domain\DTO\SearchMessageSegmentDto;

use Epush\Core\MessageSegment\Domain\UseCase\ListMessageSegmentsUseCase;
use Epush\Core\MessageSegment\Domain\UseCase\SearchMessageSegmentUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message-segment')]
class MessageSegmentController
{
    #[Get('/')]
    public function listMessageSegments(ListMessageSegmentsDto $listMessageSegmentsDto, ListMessageSegmentsUseCase $listMessageSegmentsUseCase): Response
    {
        return successJSONResponse($listMessageSegmentsUseCase->execute($listMessageSegmentsDto));
    }

    #[Post('/search')]
    public function searchMessageSegmentColumn(SearchMessageSegmentDto $searchMessageSegmentDto, SearchMessageSegmentUseCase $searchMessageSegmentUseCase): Response
    {
        return successJSONResponse($searchMessageSegmentUseCase->execute($searchMessageSegmentDto));
    }
}