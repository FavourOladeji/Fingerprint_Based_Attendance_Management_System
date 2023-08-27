<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response | RedirectResponse
    {
        if ($request->user()->user_type !== UserType::Admin) {
            toastr()->warning('You are currently not authorized');
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
