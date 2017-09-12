<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Jobs\CreateUser;
use App\Jobs\CreateToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $user = dispatch_now(CreateUser::from($request));

        return (new UserResource($user))->additional([
            'token' => dispatch_now(new CreateToken($user)),
        ]);
    }
}
