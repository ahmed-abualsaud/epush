<?php

namespace Epush\Mail\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\Mail\Domain\DTO\MailTemplateDto;
use Epush\Mail\Domain\DTO\AddMailTemplateDto;
use Epush\Mail\Domain\DTO\UpdateMailTemplateDto;

use Epush\Mail\Domain\UseCase\AddMailTemplateUseCase;
use Epush\Mail\Domain\UseCase\GetMailTemplateUseCase;
use Epush\Mail\Domain\UseCase\ListMailTemplatesUseCase;
use Epush\Mail\Domain\UseCase\DeleteMailTemplateUseCase;
use Epush\Mail\Domain\UseCase\UpdateMailTemplateUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/mail')]
class MailTemplateController
{
    #[Get('template')]
    public function listMailTemplates(ListMailTemplatesUseCase $listMailTemplatesUseCase): Response
    {
        return successJSONResponse($listMailTemplatesUseCase->execute());
    }

    #[Post('template')]
    public function addMailTemplate(AddMailTemplateDto $addMailTemplateDto, AddMailTemplateUseCase $addMailTemplateUseCase): Response
    {
        return successJSONResponse($addMailTemplateUseCase->execute($addMailTemplateDto));
    }

    #[Get('template/{mail_template_id}')]
    public function getMailTemplate(MailTemplateDto $mailTemplateDto, GetMailTemplateUseCase $getMailTemplateUseCase): Response
    {
        return successJSONResponse($getMailTemplateUseCase->execute($mailTemplateDto));
    }

    #[Put('template/{mail_template_id}')]
    public function updateMailTemplate(MailTemplateDto $mailTemplateDto, UpdateMailTemplateDto $updateMailTemplateDto, UpdateMailTemplateUseCase $updateMailTemplateUseCase): Response
    {
        return successJSONResponse($updateMailTemplateUseCase->execute($mailTemplateDto, $updateMailTemplateDto));
    }

    #[Delete('template/{mail_template_id}')]
    public function deleteMailTemplate(MailTemplateDto $mailTemplateDto, DeleteMailTemplateUseCase $deleteMailTemplateUseCase): Response
    {
        return successJSONResponse($deleteMailTemplateUseCase->execute($mailTemplateDto));
    }
}