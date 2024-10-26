<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $roleId
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roleId)
    {
        // Check if the user is authenticated and has the required role ID
        if ($request->user() && $request->user()->roleid === (int)$roleId) {
            return $next($request);
        }

        // If the user does not have the required role ID, return a forbidden response
        return response()->json(['error' => 'Forbidden'], 403);
    }
}
