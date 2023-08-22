<?php
 
namespace Epush\Auth\User\Present\Http\Middleware;
 
use Closure;
use Exception;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Epush\Shared\App\Contract\OrchiServiceContract;
use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;


class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $url = $request->url();
        $path = $request->path();
        $method = $request->method();

        $handler = app(OrchiServiceContract::class)->getHandlerByEndpoint($method . "|" . $url);

        if (empty($handler)) {
            return failureJSONResponse('the requested feature needs to be registered in the database', 403);
        }

        if (! $handler['enabled']) {
            return failureJSONResponse('The requested feature has been disabled', 403);
        }

        if ($method === 'POST' && in_array($path, [
                'api/auth/user/signin', 
                'api/auth/user/signup', 
                'api/auth/user/reset-password',
            ])) {

            return $next($request);
        }

        $access_token = $request->header('Authorization');

        if (!$access_token) {
            return failureJSONResponse('Access token not found', 401);
        }

        try {
            $payload = app(CredentialsServiceContract::class)->decodeToken(substr($access_token, 7));

        } catch (Exception $e) {
            return failureJSONResponse('Invalid access token', 401);
        }

        if ($payload['exp'] < time()) {
            return failureJSONResponse('Access token expired', 401);
        }
        $permissions = app(UserServiceContract::class)->getAllUserPermissions($payload['sub']);

        $permissions = array_filter($permissions, function ($permission) use ($method, $path) {

            if ($permission['context_name'] != 'http') { return false; }

            $conditions = true;
            $pathSegments = explode('/', $path);
            $endpointSegments = explode('/', $permission['handler_endpoint']);
            if (count($endpointSegments) !== count($pathSegments) + 3) { return false; }
            $endpointMethod = explode('|', $endpointSegments[0])[0];

            foreach ($pathSegments as $key => $value) {
                $conditions =  $endpointSegments[$key + 3] === $value || preg_match('/\{(.*?)\}/' ,$endpointSegments[$key + 3]) && $endpointMethod === $method && $conditions;
                if (! $conditions) return false;
            }

            return true;
        });

        if (empty($permissions)) {
            return failureJSONResponse('You don\'t have access to the requested feature', 403);
        }

        return $next($request);
    }
}