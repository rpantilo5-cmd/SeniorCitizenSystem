<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  list<string>  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $allowedRoles = collect($roles)
            ->flatMap(fn (string $role) => explode(',', $role))
            ->map(fn (string $role) => trim($role))
            ->filter()
            ->unique()
            ->values()
            ->all();

        abort_unless(
            $request->user() && in_array($request->user()->role, $allowedRoles, true),
            403,
            'Unauthorized. You do not have permission to access this resource.'
        );

        return $next($request);
    }
}
