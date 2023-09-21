<?php

namespace Epush\Core\MessageLanguage\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\MessageLanguage\Domain\DTO\MessageLanguageDto;
use Epush\Core\MessageLanguage\Domain\DTO\AddMessageLanguageDto;
use Epush\Core\MessageLanguage\Domain\DTO\ListMessageLanguagesDto;
use Epush\Core\MessageLanguage\Domain\DTO\SearchMessageLanguageDto;
use Epush\Core\MessageLanguage\Domain\DTO\UpdateMessageLanguageDto;

use Epush\Core\MessageLanguage\Domain\UseCase\GetMessageLanguageUseCase;
use Epush\Core\MessageLanguage\Domain\UseCase\AddMessageLanguageUseCase;
use Epush\Core\MessageLanguage\Domain\UseCase\ListMessageLanguagesUseCase;
use Epush\Core\MessageLanguage\Domain\UseCase\DeleteMessageLanguageUseCase;
use Epush\Core\MessageLanguage\Domain\UseCase\SearchMessageLanguageUseCase;
use Epush\Core\MessageLanguage\Domain\UseCase\UpdateMessageLanguageUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/message-language')]
class MessageLanguageController
{
    #[Get('/')]
    public function listMessageLanguages(ListMessageLanguagesDto $listMessageLanguagesDto, ListMessageLanguagesUseCase $listMessageLanguagesUseCase): Response
    {
        return successJSONResponse($listMessageLanguagesUseCase->execute($listMessageLanguagesDto));
    }

    #[Post('/')]
    public function addMessageLanguage(AddMessageLanguageDto $addMessageLanguageDto, AddMessageLanguageUseCase $addMessageLanguageUseCase): Response
    {
        return successJSONResponse($addMessageLanguageUseCase->execute($addMessageLanguageDto));
    }

    #[Get('{message_language_id}')]
    public function getMessageLanguage(MessageLanguageDto $messageLanguageDto, GetMessageLanguageUseCase $getMessageLanguageUseCase): Response
    {
        return successJSONResponse($getMessageLanguageUseCase->execute($messageLanguageDto));
    }

    #[Put('{message_language_id}')]
    public function updateMessageLanguage(MessageLanguageDto $messageLanguageDto, UpdateMessageLanguageDto $updateMessageLanguageDto, UpdateMessageLanguageUseCase $updateMessageLanguageUseCase): Response
    {
        return successJSONResponse($updateMessageLanguageUseCase->execute($messageLanguageDto, $updateMessageLanguageDto));
    }

    #[Delete('{message_language_id}')]
    public function deleteMessageLanguage(MessageLanguageDto $messageLanguageDto, DeleteMessageLanguageUseCase $deleteMessageLanguageUseCase): Response
    {
        return successJSONResponse($deleteMessageLanguageUseCase->execute($messageLanguageDto));
    }

    #[Post('/search')]
    public function searchMessageLanguageColumn(SearchMessageLanguageDto $searchMessageLanguageDto, SearchMessageLanguageUseCase $searchMessageLanguageUseCase): Response
    {
        return successJSONResponse($searchMessageLanguageUseCase->execute($searchMessageLanguageDto));
    }
}