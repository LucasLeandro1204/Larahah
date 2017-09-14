<?php

namespace App\Http\Controllers\Auth;

use Hash;
use JWTAuth;
use App\User;
use App\Jobs\CreateToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function login()
    {
        $credentials = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            $token = JWTAuth::attempt($credentials);
        } catch (JWTException $e) {
            abort(500, 'An error occurred');
        }

        if (!$token) {
            return response()->json([
                'errors' => [
                    'login' => [
                        'Please, check your credentials',
                    ],
                ],
            ], 403);
        }

        return (new UserResource(User::findByEmail(request('email'))))->additional([
            'token' => $token,
        ]);
    }

    public function check()
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            abort(401);
        }

        return response('OK', 200);
    }

    public function logout()
    {
        try {
            $token = JWTAuth::getToken();
            if ($token) {
                JWTAuth::invalidate($token);
            }
        } catch (JWTException $e) {
            abort(401);
        }

        return response('OK', 200);
    }
}
