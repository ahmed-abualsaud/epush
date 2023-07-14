<?php
 
namespace Epush\Shared\Present;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Epush\Shared\Present\Response as PresentResponse;
 
class ResponseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
 
        if ($response instanceof PresentResponse) {
            return $response->getOriginalResponse();
        }
 
        return $response;
    }
}