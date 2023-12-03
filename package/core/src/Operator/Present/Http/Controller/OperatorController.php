<?php

namespace Epush\Core\Operator\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Operator\Domain\DTO\OperatorDto;
use Epush\Core\Operator\Domain\DTO\AddOperatorDto;
use Epush\Core\Operator\Domain\DTO\ListOperatorsDto;
use Epush\Core\Operator\Domain\DTO\SearchOperatorDto;
use Epush\Core\Operator\Domain\DTO\UpdateOperatorDto;

use Epush\Core\Operator\Domain\UseCase\GetOperatorUseCase;
use Epush\Core\Operator\Domain\UseCase\AddOperatorUseCase;
use Epush\Core\Operator\Domain\UseCase\ListOperatorsUseCase;
use Epush\Core\Operator\Domain\UseCase\DeleteOperatorUseCase;
use Epush\Core\Operator\Domain\UseCase\SearchOperatorUseCase;
use Epush\Core\Operator\Domain\UseCase\UpdateOperatorUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/operator')]
class OperatorController
{
    #[Get('/')]
    public function listOperators(ListOperatorsDto $listOperatorsDto, ListOperatorsUseCase $listOperatorsUseCase): Response
    {
        return jsonResponse($listOperatorsUseCase->execute($listOperatorsDto));
    }

    #[Post('/')]
    public function addOperator(AddOperatorDto $addOperatorDto, AddOperatorUseCase $addOperatorUseCase): Response
    {
        return jsonResponse($addOperatorUseCase->execute($addOperatorDto));
    }

    #[Get('{operator_id}')]
    public function getOperator(OperatorDto $operatorDto, GetOperatorUseCase $getOperatorUseCase): Response
    {
        return jsonResponse($getOperatorUseCase->execute($operatorDto));
    }

    #[Put('{operator_id}')]
    public function updateOperator(OperatorDto $operatorDto, UpdateOperatorDto $updateOperatorDto, UpdateOperatorUseCase $updateOperatorUseCase): Response
    {
        return jsonResponse($updateOperatorUseCase->execute($operatorDto, $updateOperatorDto));
    }

    #[Delete('{operator_id}')]
    public function deleteOperator(OperatorDto $operatorDto, DeleteOperatorUseCase $deleteOperatorUseCase): Response
    {
        return jsonResponse($deleteOperatorUseCase->execute($operatorDto));
    }

    #[Post('/search')]
    public function searchOperatorColumn(SearchOperatorDto $searchOperatorDto, SearchOperatorUseCase $searchOperatorUseCase): Response
    {
        return jsonResponse($searchOperatorUseCase->execute($searchOperatorDto));
    }
}