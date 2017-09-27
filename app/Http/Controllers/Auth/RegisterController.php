<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use App\User;
use App\Jobs\CreateUser;
use App\Jobs\CreateToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\CreateUserRequest;

class RegisterController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        $user = dispatch_now(CreateUser::from($request));

        return (new UserResource($user))->additional([
            'token' => JWTAuth::fromUser($user),
        ]);
    }
}
