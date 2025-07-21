<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle(Request $request, Closure $next, ...$roles): Response
{   
    if (Auth::check() && !in_array(Auth::user()->role, $roles)) {
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}

}