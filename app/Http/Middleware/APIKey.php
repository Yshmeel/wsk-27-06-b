<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class APIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $user = User::query()->where("token", $token)->first();

        if(!$user) {
            return \response()->json([
                'errors' => [
                    'token' => 'Invalid token'
                ]
            ])->setStatusCode(401);
        }

        Auth::setUser($user);
        return $next($request);
    }
}
