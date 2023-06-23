<?php

namespace Epush\Shared\Infra\Provider;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Debug\ExceptionHandler;

use Epush\Shared\Present\ResponseMiddleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SharedServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app(Kernel::class)->pushMiddleware(ResponseMiddleware::class);
        app(Kernel::class)->prependToMiddlewarePriority(ResponseMiddleware::class);


        $appExceptionHandeler = $this->app[ExceptionHandler::class];
        if (!empty($appExceptionHandeler) && method_exists($appExceptionHandeler, 'renderable')) {

            $appExceptionHandeler->renderable(function (ValidationException $e) {
                return failureJSONResponse($e->getMessage(), $e->status);
            });

            $appExceptionHandeler->renderable(function (NotFoundHttpException $e) {
                return failureJSONResponse($e->getMessage(), $e->getStatusCode());
            });
        }
    }


    public function register()
    {
        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);
        require_once(__DIR__.'/../../Present/HttpHelper.php');
    }
}