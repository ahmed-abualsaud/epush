<?php
 
namespace Epush\Auth\User\Present\Http\Middleware;
 
use Closure;
use Exception;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Epush\Auth\User\App\Contract\UserServiceContract;
use Epush\Auth\User\App\Contract\CredentialsServiceContract;
use Epush\Shared\Infra\InterprocessCommunication\Contract\InterprocessCommunicationEngineContract;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $url = $request->url();
        $path = $request->path();
        $method = $request->method();
        $response = $next($request);

        if (stringContains($path, "storage")) {
            return $response;
        }

        if (stringContains($path, "control/timestamp") && $method === 'GET') {
            return jsonResponse(app(InterprocessCommunicationEngineContract::class)->broadcast("cache:get", "control_timestamp")[0]);
        }

        if (stringContains($path, "control/timestamp") && $method === 'POST') {
            return jsonResponse(app(InterprocessCommunicationEngineContract::class)->broadcast("cache:put", "control_timestamp", $request->input('control_timestamp'))[0]);
        }

        if (in_array($method, ['GET', 'POST']) && stringContains($path, "queue")) {

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

            return $response;
        }

        $handler = app(InterprocessCommunicationEngineContract::class)->broadcast("orchi:handler:get-handler-by-endpoint", $method . "|" . $url)[0];

        if (empty($handler)) {
            return failureJSONResponse('the requested feature needs to be registered in our system', 403);
        }

        if (! $handler['enabled']) {
            return failureJSONResponse('The requested feature has been disabled', 403);
        }

        if (in_array($method, ['GET', 'POST']) && in_array($path, ['api/v2/send_bulk', 'api/v2/check_balance'])) {
            return $response;
        }

        if ($method === 'POST' && in_array($path, [
                'api/auth/user/signin', 
                'api/auth/user/signup', 
                'api/auth/user/verify-account',
                'api/auth/user/reset-password',
                'api/auth/user/forget-password',
            ])) {

            app(InterprocessCommunicationEngineContract::class)->broadcast("sms:send", $handler, $request, $response)[0];
            app(InterprocessCommunicationEngineContract::class)->broadcast("mail:send", $handler, $request, $response)[0];
            app(InterprocessCommunicationEngineContract::class)->broadcast("notification:send", $handler, $request, $response)[0];
            return $response;
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
            return failureJSONResponse('You don\'t have access to the requested feature '.$method.'|'.$path, 403);
        }

        if (! in_array($handler['name'], ["sendMessage", "sendBulkGet", "sendBulkPost", "bulkAddMessage", "addMessage"])) {
            app(InterprocessCommunicationEngineContract::class)->broadcast("sms:send", $handler, $request, $response)[0];
            app(InterprocessCommunicationEngineContract::class)->broadcast("mail:send", $handler, $request, $response)[0];
            app(InterprocessCommunicationEngineContract::class)->broadcast("notification:send", $handler, $request, $response)[0];
        }

        return $response;
    }
}