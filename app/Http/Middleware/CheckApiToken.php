<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckApiToken {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::guard('api')->user() !== null) {
            return $next($request);
        }

        return response()->json(['message' => 'Not authenticated'], 401);
    }
}
