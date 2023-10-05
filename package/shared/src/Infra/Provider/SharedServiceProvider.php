<?php

namespace Epush\Shared\Infra\Provider;

use Exception;
use InvalidArgumentException;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Debug\ExceptionHandler;

use Epush\Shared\Present\ResponseMiddleware;
use Illuminate\Auth\AuthenticationException;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SharedServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app(Kernel::class)->pushMiddleware(ResponseMiddleware::class);
        app(Kernel::class)->prependToMiddlewarePriority(ResponseMiddleware::class);


        $appExceptionHandeler = $this->app[ExceptionHandler::class];
        if (!empty($appExceptionHandeler) && method_exists($appExceptionHandeler, 'renderable')) {

            $appExceptionHandeler->renderable(function (AuthenticationException $e) {
                return failureJSONResponse($e->getMessage(), 401);
            });

            $appExceptionHandeler->renderable(function (ValidationException $e) {
                return failureJSONResponse($e->getMessage(), $e->status);
            });

            $appExceptionHandeler->renderable(function (NotFoundHttpException $e) {
                return failureJSONResponse($e->getMessage(), $e->getStatusCode());
            });

            $appExceptionHandeler->renderable(function (InvalidArgumentException $e) {
                return failureJSONResponse($e->getMessage(), 400);
            });

            $appExceptionHandeler->renderable(function (Exception $e) {
                return failureJSONResponse($e->getMessage(), 500);
            });
        }
    }


    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/route-attributes.php', 'route-attributes');

        $this->app->register(AppProvider::class);
        $this->app->register(InfraProvider::class);

        require_once(__DIR__.'/../Utils/ArrayUtils.php');
        require_once(__DIR__.'/../../Present/HttpHelper.php');
    }
}