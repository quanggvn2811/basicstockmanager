<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimpleVerify
{
    const ACCESS_ROLE = ['admin', 'staff'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // access_token = admin/staff + personalConfigToken
        $accessToken = $request->associated_session;

        if (!$accessToken) {
            abort(404);
        }

        $role = strtolower(substr($accessToken, 0, 5));

        if (!in_array($role, self::ACCESS_ROLE)) {
            abort(404);
        }

        $canAccess = $accessToken === env('APP_ADMIN_ACCESS_TOKEN') || $accessToken === env('APP_STAFF_ACCESS_TOKEN');

        if (!$canAccess) {
            abort(404);
        }

        return $next($request);
    }
}
