<?php
namespace Mynorel\Http\Middleware;

use Mynorel\Http\Request;
use Mynorel\Http\Response;
use Mynorel\Http\Csrf;

/**
 * CsrfMiddleware: Protects against CSRF attacks for POST/PUT/PATCH/DELETE requests.
 */
class CsrfMiddleware
{
    public function __invoke(Request $request, callable $next)
    {
        $method = $request->method();
        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $token = $request->input('csrf_token') ?? $request->query('csrf_token');
            if (!Csrf::validate($token)) {
                return new Response('Invalid CSRF token', 419);
            }
        }
        return $next($request);
    }
}
