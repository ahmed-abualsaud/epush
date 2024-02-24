<?php
 
namespace Epush\Auth\User\Present\Http\Middleware;
 
use Closure;
use Exception;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class RefreshTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->path();
        $method = $request->method();

        if ($method === 'POST' && in_array($path, [
            'api/auth/user/signin', 
            'api/auth/user/signup', 
            'api/auth/user/verify-account',
            'api/auth/user/reset-password',
            'api/auth/user/forget-password',
        ])) {

            return $next($request);
        }

        if ($request->hasCookie('refresh_token')) {
            $new_token = $this->getToken($request->cookie('refresh_token'));
            $request->headers->set('Authorization', 'Bearer ' . $new_token);
        }

        if (in_array($method, ['GET', 'POST']) && in_array($path, ['api/auth/user/refresh-token'])) {
            if (! isset($new_token)) {
                if (empty($request->only('refresh_token'))) {return failureJSONResponse("Refresh token is required", 400);}
                $new_token = $this->getToken($request->headers->get('refresh_token'));
            }
            return ! isset($new_token->original) ? jsonResponse(['access_token' => $new_token]) : failureJSONResponse("Invalid refresh token", 400);
        }
        return $next($request);
    }

    private function getToken($refresh_token)
    {
        JWTAuth::setToken($refresh_token);
        return JWTAuth::refresh();
    }
}