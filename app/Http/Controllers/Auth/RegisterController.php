<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use App\User;
use App\Jobs\CreateUser;
use App\Jobs\CreateToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class RegisterController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3|max:140',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|min:3|max:25',
        ]);

        $user = dispatch_now(new CreateUser(request()->all()));

        return (new UserResource($user))->additional([
            'token' => JWTAuth::fromUser($user),
        ]);
    }
}
