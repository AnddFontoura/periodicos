<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RefreshApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $token = Str::random(80);

            $user->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();
        }

        return $next($request);
    }
}
