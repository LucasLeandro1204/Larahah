<?php

namespace App\Http\Controllers\Auth;

use Hash;
use JWTAuth;
use App\User;
use App\Jobs\CreateToken;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request): UserResource
    {
        $user = $request->getUser();

        if (! Hash::check($data['password'], $user->password)) {
            return response()->json([], 401);
        }

        return (new UserResource($user))->additional([
            'token' => dispatch_now(new CreateToken($user)),
        ]);
    }
}
