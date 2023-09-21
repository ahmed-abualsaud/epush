<?php

namespace Epush\Core\MessageSegment\Domain\UseCase;

use Epush\Core\MessageSegment\Domain\DTO\ListMessageSegmentsDto;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class ListMessageSegmentsUseCase
{
    public function __construct(

        private MessageSegmentServiceContract $messageSegmentService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(ListMessageSegmentsDto $listMessageSegmentsDto): array
    {
        $this->validationService->validate($listMessageSegmentsDto->toArray(), ListMessageSegmentsDto::rules());
        return $this->messageSegmentService->list($listMessageSegmentsDto->getPageSize());
    }
}