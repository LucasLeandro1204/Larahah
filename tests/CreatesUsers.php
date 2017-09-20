<?php

namespace Tests;

use App\User;

trait CreatesUsers
{
    protected function createUser(array $attributes = []): User
    {
        return factory(User::class)->create($attributes);
    }
}
