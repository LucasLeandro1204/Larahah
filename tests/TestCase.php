<?php

namespace Tests;

use JWTAuth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, CreatesUsers;

    public function actingAs(Authenticatable $user, $driver = null)
    {
        $token = JWTAuth::fromUser($user);
        JWTAuth::setToken($token);

        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ]);
    }
}
