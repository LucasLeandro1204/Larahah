<?php

namespace App\Jobs;

use App\User;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateUser
{
    use Dispatchable;

    /**
     * The user data.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return \App\User
     */
    public function handle(): User
    {
        return tap(new User($this->data))->save();
    }
}
