<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserAktif
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->user() && !$request->user()->is_aktif) {
            return response()->json([
                'message' => 'Akun Anda tidak aktif. Hubungi administrator.'
            ], 403);
        }

        return $next($request);
    }
}