<?php

namespace Epush\SMS\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

use Epush\SMS\Domain\DTO\SMSTemplateDto;
use Epush\SMS\Domain\DTO\AddSMSTemplateDto;
use Epush\SMS\Domain\DTO\UpdateSMSTemplateDto;

use Epush\SMS\Domain\UseCase\AddSMSTemplateUseCase;
use Epush\SMS\Domain\UseCase\GetSMSTemplateUseCase;
use Epush\SMS\Domain\UseCase\ListSMSTemplatesUseCase;
use Epush\SMS\Domain\UseCase\DeleteSMSTemplateUseCase;
use Epush\SMS\Domain\UseCase\UpdateSMSTemplateUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/sms')]
class SMSTemplateController
{
    #[Get('template')]
    public function listSMSTemplates(ListSMSTemplatesUseCase $listSMSTemplatesUseCase): Response
    {
        return successJSONResponse($listSMSTemplatesUseCase->execute());
    }

    #[Post('template')]
    public function addSMSTemplate(AddSMSTemplateDto $addSMSTemplateDto, AddSMSTemplateUseCase $addSMSTemplateUseCase): Response
    {
        return successJSONResponse($addSMSTemplateUseCase->execute($addSMSTemplateDto));
    }

    #[Get('template/{sms_template_id}')]
    public function getSMSTemplate(SMSTemplateDto $smsTemplateDto, GetSMSTemplateUseCase $getSMSTemplateUseCase): Response
    {
        return successJSONResponse($getSMSTemplateUseCase->execute($smsTemplateDto));
    }

    #[Put('template/{sms_template_id}')]
    public function updateSMSTemplate(SMSTemplateDto $smsTemplateDto, UpdateSMSTemplateDto $updateSMSTemplateDto, UpdateSMSTemplateUseCase $updateSMSTemplateUseCase): Response
    {
        return successJSONResponse($updateSMSTemplateUseCase->execute($smsTemplateDto, $updateSMSTemplateDto));
    }

    #[Delete('template/{sms_template_id}')]
    public function deleteSMSTemplate(SMSTemplateDto $smsTemplateDto, DeleteSMSTemplateUseCase $deleteSMSTemplateUseCase): Response
    {
        return successJSONResponse($deleteSMSTemplateUseCase->execute($smsTemplateDto));
    }
}