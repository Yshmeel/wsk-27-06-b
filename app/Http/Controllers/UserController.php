<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(LoginRequest $request) {
        $login = $request->get("login");
        $pin = $request->get("pin");

        $user = User::query()->where('login', $login)->firstOrCreate([
            'login' => $login,
            'pin' => $pin,
            'token' => ''
        ]);

        if($user->pin != $pin) {
            return response()->json([
                'errors' => [
                    'pin' => 'Incorrect pin-code'
                ]
            ])->setStatusCode(422);
        }

        $user->token = Str::random(32);
        $user->save();

        return response()->json([
            'data' => [
                'token' => $user->token
            ]
        ]);
    }
}
