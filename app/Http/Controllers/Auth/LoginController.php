<?php

namespace App\Http\Controllers\Auth;

use Hash;
use JWTAuth;
use App\User;
use App\Jobs\CreateToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;

class LoginController extends Controller
{
    public function login()
    {
        $data = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->firstOrFail();

        if (! Hash::check($data['password'], $user->password)) {
            return response()->json([], 401);
        }

        return (new UserResource($user))->additional([
            'token' => dispatch_now(new CreateToken($user)),
        ]);
    }
}
