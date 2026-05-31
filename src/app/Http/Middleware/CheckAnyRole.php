<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAnyRole
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $user = $request->user();
        $roleArray = explode('|', $roles);

        if (!$user || !$user->hasAnyRole($roleArray)) {
            return response()->json([
                'message' => 'Insufficient permissions',
            ], 403);
        }

        return $next($request);
    }
}
