<?php

namespace Epush\Core\MessageSegment\Domain\UseCase;

use Epush\Core\MessageSegment\Domain\DTO\SearchMessageSegmentDto;
use Epush\Core\MessageSegment\App\Contract\MessageSegmentServiceContract;
use Epush\Shared\App\Contract\ValidationServiceContract;

class SearchMessageSegmentUseCase
{
    public function __construct(

        private MessageSegmentServiceContract $messageSegmentService,
        private ValidationServiceContract $validationService

    ) {}

    public function execute(SearchMessageSegmentDto $searchMessageSegmentDto): array
    {
        $this->validationService->validate($searchMessageSegmentDto->toArray(), SearchMessageSegmentDto::rules());
        return $this->messageSegmentService->searchColumn(
            $searchMessageSegmentDto->getSearchColumn(),
            $searchMessageSegmentDto->getSearchValue(),
            $searchMessageSegmentDto->getPageSize(),
            $searchMessageSegmentDto->getPartnerID()
        );
    }
}