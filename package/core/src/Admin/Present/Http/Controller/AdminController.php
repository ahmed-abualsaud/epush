<?php

namespace Epush\Core\Admin\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Admin\Domain\DTO\AdminDto;
use Epush\Core\Admin\Domain\DTO\AddAdminDto;
use Epush\Core\Admin\Domain\DTO\ListAdminsDto;
use Epush\Core\Admin\Domain\DTO\SearchAdminDto;
use Epush\Core\Admin\Domain\DTO\UpdateAdminDto;

use Epush\Core\Admin\Domain\UseCase\GetAdminUseCase;
use Epush\Core\Admin\Domain\UseCase\AddAdminUseCase;
use Epush\Core\Admin\Domain\UseCase\ListAdminsUseCase;
use Epush\Core\Admin\Domain\UseCase\DeleteAdminUseCase;
use Epush\Core\Admin\Domain\UseCase\SearchAdminUseCase;
use Epush\Core\Admin\Domain\UseCase\UpdateAdminUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/admin')]
class AdminController
{
    #[Get('/')]
    public function listAdmins(ListAdminsDto $listAdminsDto, ListAdminsUseCase $listAdminsUseCase): Response
    {
        return successJSONResponse($listAdminsUseCase->execute($listAdminsDto));
    }

    #[Post('/')]
    public function addAdmin(AddAdminDto $addAdminDto, AddAdminUseCase $addAdminUseCase): Response
    {
        return successJSONResponse($addAdminUseCase->execute($addAdminDto));
    }

    #[Get('{user_id}')]
    public function getAdmin(AdminDto $adminDto, GetAdminUseCase $getAdminUseCase): Response
    {
        return successJSONResponse($getAdminUseCase->execute($adminDto));
    }

    #[Put('{user_id}')]
    public function updateAdmin(AdminDto $adminDto, UpdateAdminDto $updateAdminDto, UpdateAdminUseCase $updateAdminUseCase): Response
    {
        return successJSONResponse($updateAdminUseCase->execute($adminDto, $updateAdminDto));
    }

    #[Delete('{user_id}')]
    public function deleteAdmin(AdminDto $adminDto, DeleteAdminUseCase $deleteAdminUseCase): Response
    {
        return successJSONResponse($deleteAdminUseCase->execute($adminDto));
    }

    #[Post('/search')]
    public function searchAdminColumn(SearchAdminDto $searchAdminDto, SearchAdminUseCase $searchAdminUseCase): Response
    {
        return successJSONResponse($searchAdminUseCase->execute($searchAdminDto));
    }
}