<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Jobs\CreateUser;
use App\Jobs\CreateToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;

class RegisterController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3|max:140',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|min:3|max:25',
            'password' => 'required|confirmed',
        ]);

        $user = dispatch_now(new CreateUser($data));

        return (new UserResource($user))->additional([
            'token' => dispatch_now(new CreateToken($data)),
        ]);
    }
}
