<?php

namespace Epush\Search\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Search\Domain\DTO\SearchDto;
use Epush\Search\Domain\UseCase\SearchUseCase;

use Symfony\Component\HttpFoundation\Response;

#[Prefix('api/search')]
class SearchController
{
    #[Post('/')]
    public function search(SearchDto $searchDto, SearchUseCase $searchUseCase): Response
    {
        return jsonResponse($searchUseCase->execute($searchDto));
    }
}