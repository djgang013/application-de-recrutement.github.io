<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()->role !== $role) {
            return redirect('/'); // Redirect to another page if the user does not have the correct role
        }
        return $next($request);
    }
}







