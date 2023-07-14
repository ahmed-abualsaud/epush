<?php
 
namespace Epush\Auth\Present\Http\Middleware;
 
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Epush\Auth\App\Contract\PermissionServiceContract;
use Epush\Auth\App\Contract\CredentialsServiceContract;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $method = $request->method();
        $path = $request->path();

        if ($method === 'POST' && in_array($path, [
                'api/auth/signin', 
                'api/auth/signup', 
                'api/auth/reset-password',
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

        $permissions = app(PermissionServiceContract::class)->getAllUserPermissions($payload['sub']);

        $permissions = array_filter($permissions, function ($permission) use ($method, $path, $request) {

            if ($permission['context_name'] != 'http') { return false; }

            $conditions = true;
            $pathSegments = explode('/', $path);
            $endpointSegments = explode('/', $permission['handler_endpoint']);

            foreach ($pathSegments as $key => $value) {
                $conditions =  $endpointSegments[$key + 3] === $value || preg_match('/\{(.*?)\}/' ,$endpointSegments[$key + 3]) && $conditions;
                if (! $conditions) return false;
            }
            return true;
        });

        if (empty($permissions)) {
            return failureJSONResponse('You don\'t have access to this feature', 403);
        }

        return $next($request);
    }
}