<?php

namespace App\Jobs;

use JWTAuth;
use App\User;

class CreateToken
{
    /**
     * The user data.
     *
     * @var \App\User
     */
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return string
     */
    public function handle(): string
    {
        return JWTAuth::fromUser($this->user);
    }
}
