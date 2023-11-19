<?php

namespace Epush\File\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\File\Domain\DTO\FolderDto;
use Epush\File\Domain\DTO\AddFolderDto;
use Epush\File\Domain\DTO\ListFoldersDto;
use Epush\File\Domain\DTO\SearchFolderDto;
use Epush\File\Domain\DTO\UpdateFolderDto;

use Epush\File\Domain\UseCase\GetFolderUseCase;
use Epush\File\Domain\UseCase\AddFolderUseCase;
use Epush\File\Domain\UseCase\ListFoldersUseCase;
use Epush\File\Domain\UseCase\DeleteFolderUseCase;
use Epush\File\Domain\UseCase\SearchFolderUseCase;
use Epush\File\Domain\UseCase\UpdateFolderUseCase;
use Epush\File\Domain\UseCase\GetFolderFilesUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/folder')]
class FolderController
{
    #[Get('/')]
    public function listFolders(ListFoldersDto $listFoldersDto, ListFoldersUseCase $listFoldersUseCase): Response
    {
        return successJSONResponse($listFoldersUseCase->execute($listFoldersDto));
    }

    #[Post('/')]
    public function addFolder(AddFolderDto $addFolderDto, AddFolderUseCase $addFolderUseCase): Response
    {
        return successJSONResponse($addFolderUseCase->execute($addFolderDto));
    }

    #[Get('{folder_id}')]
    public function getFolder(FolderDto $folderDto, GetFolderUseCase $getFolderUseCase): Response
    {
        return successJSONResponse($getFolderUseCase->execute($folderDto));
    }

    #[Put('{folder_id}')]
    public function updateFolder(FolderDto $folderDto, UpdateFolderDto $updateFolderDto, UpdateFolderUseCase $updateFolderUseCase): Response
    {
        return successJSONResponse($updateFolderUseCase->execute($folderDto, $updateFolderDto));
    }

    #[Delete('{folder_id}')]
    public function deleteFolder(FolderDto $folderDto, DeleteFolderUseCase $deleteFolderUseCase): Response
    {
        return successJSONResponse($deleteFolderUseCase->execute($folderDto));
    }

    #[Post('/search')]
    public function searchFolderColumn(SearchFolderDto $searchFolderDto, SearchFolderUseCase $searchFolderUseCase): Response
    {
        return successJSONResponse($searchFolderUseCase->execute($searchFolderDto));
    }

    #[Get('{folder_id}/files')]
    public function getFolderFiles(FolderDto $folderDto, GetFolderFilesUseCase $getFolderFilesUseCase): Response
    {
        return successJSONResponse($getFolderFilesUseCase->execute($folderDto));
    }
}