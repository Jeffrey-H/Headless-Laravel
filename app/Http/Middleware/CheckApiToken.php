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

        if (User::where('id', Auth::guard('api')->user()->id)->exists()) {
            return $next($request);
        }

        return response()->json(['message' => 'Not authenticated'], 401);
    }
}
