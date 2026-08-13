<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PastikanPenggunaPanel
{
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::user()?->role;

        if (! in_array($role, ['admin', 'marketing'], true)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}