<?php

namespace Modules\Administration\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticate;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class Authenticate extends BaseAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param array $guards
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (!$guards) {
            $route = $request->route();
            $permission_route = $route->getAction('permission');
            if ($permission_route === null) {
                $permission_route = $route->getName();
            }

            if (!isAdmin() && $permission_route && !$request->user()->hasAnyPermission((array)$permission_route)) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Unauthenticated.'], 401);
                }
                abort(403);
            }
        }

        return $next($request);
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('get.login');
        }
    }
}
