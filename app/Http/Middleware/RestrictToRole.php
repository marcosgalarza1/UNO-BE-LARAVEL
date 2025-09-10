<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class RestrictToRole
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!auth('sanctum')->check() || auth('sanctum')->user()->role->name !== $role) {
            return response()->json([
                'error' => [
                    'message' => 'Forbidden: Insufficient role permissions',
                    'code' => 403
                ]
            ], 403);
        }
        return $next($request);
    }
}
