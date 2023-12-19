<?php

namespace Epush\Queue\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;


use Epush\Queue\Domain\DTO\QueueJobDto;
use Epush\Queue\Domain\DTO\ListQueueJobsDto;
use Epush\Queue\Domain\DTO\SearchQueueJobDto;
use Epush\Queue\Domain\DTO\QueueFailedJobDto;
use Epush\Queue\Domain\DTO\CheckQueueEnabledDto;
use Epush\Queue\Domain\DTO\CheckQueuesEnabledDto;
use Epush\Queue\Domain\DTO\EnableDisableQueueDto;
use Epush\Queue\Domain\DTO\EnableDisableQueuesDto;
use Epush\Queue\Domain\DTO\ListQueueFailedJobsDto;
use Epush\Queue\Domain\DTO\SearchQueueFailedJobDto;

use Epush\Queue\Domain\UseCase\GetQueueJobUseCase;
use Epush\Queue\Domain\UseCase\ListQueueJobsUseCase;
use Epush\Queue\Domain\UseCase\SearchQueueJobUseCase;
use Epush\Queue\Domain\UseCase\GetQueueFailedJobUseCase;
use Epush\Queue\Domain\UseCase\CheckQueueEnabledUseCase;
use Epush\Queue\Domain\UseCase\CheckQueuesEnabledUseCase;
use Epush\Queue\Domain\UseCase\EnableDisableQueueUseCase;
use Epush\Queue\Domain\UseCase\EnableDisableQueuesUseCase;
use Epush\Queue\Domain\UseCase\ListQueueFailedJobsUseCase;
use Epush\Queue\Domain\UseCase\SearchQueueFailedJobUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/queue')]
class QueueController
{
    #[Get('check/{queue}')]
    public function checkQueueEnabled(CheckQueueEnabledDto $checkQueueEnabledDto, CheckQueueEnabledUseCase $checkQueueEnabledUseCase): Response
    {
        return jsonResponse($checkQueueEnabledUseCase->execute($checkQueueEnabledDto));
    }

    #[Post('/check')]
    public function checkQueuesEnabled(CheckQueuesEnabledDto $checkQueuesEnabledDto, CheckQueuesEnabledUseCase $checkQueuesEnabledUseCase): Response
    {
        return jsonResponse($checkQueuesEnabledUseCase->execute($checkQueuesEnabledDto));
    }

    #[Post('/{queue}')]
    public function enableDisableQueue(EnableDisableQueueDto $enableDisableQueueDto, EnableDisableQueueUseCase $enableDisableQueueUseCase): Response
    {
        return jsonResponse($enableDisableQueueUseCase->execute($enableDisableQueueDto));
    }

    #[Post('/')]
    public function enableDisableQueues(EnableDisableQueuesDto $enableDisableQueuesDto, EnableDisableQueuesUseCase $enableDisableQueuesUseCase): Response
    {
        return jsonResponse($enableDisableQueuesUseCase->execute($enableDisableQueuesDto));
    }

    #[Get('job/{queue_id}')]
    public function getQueueJob(QueueJobDto $queueJobDto, GetQueueJobUseCase $getQueueJobUseCase): Response
    {
        return jsonResponse($getQueueJobUseCase->execute($queueJobDto));
    }

    #[Get('{queue}/jobs')]
    public function listQueueJobs(ListQueueJobsDto $listQueueJobsDto, ListQueueJobsUseCase $listQueueJobsUseCase): Response
    {
        return jsonResponse($listQueueJobsUseCase->execute($listQueueJobsDto));
    }

    #[Post('{queue}/jobs/search')]
    public function searchQueueJob(SearchQueueJobDto $searchQueueJobDto, SearchQueueJobUseCase $searchQueueJobUseCase): Response
    {
        return jsonResponse($searchQueueJobUseCase->execute($searchQueueJobDto));
    }

    #[Get('failed-job/{queue_id}')]
    public function getQueueFailedJob(QueueFailedJobDto $queueFailedJobDto, GetQueueFailedJobUseCase $getQueueFailedJobUseCase): Response
    {
        return jsonResponse($getQueueFailedJobUseCase->execute($queueFailedJobDto));
    }

    #[Get('{queue}/failed-jobs')]
    public function listQueues(ListQueueFailedJobsDto $listQueueFailedJobsDto, ListQueueFailedJobsUseCase $listQueueFailedJobsUseCase): Response
    {
        return jsonResponse($listQueueFailedJobsUseCase->execute($listQueueFailedJobsDto));
    }

    #[Post('{queue}/failed-jobs/search')]
    public function searchQueueColumn(SearchQueueFailedJobDto $searchQueueFailedJobDto, SearchQueueFailedJobUseCase $searchQueueFailedJobUseCase): Response
    {
        return jsonResponse($searchQueueFailedJobUseCase->execute($searchQueueFailedJobDto));
    }
}