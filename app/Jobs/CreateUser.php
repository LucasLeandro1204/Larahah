<?php

namespace App\Jobs;

use App\User;
use App\Http\Requests\RegisterRequest;

class CreateUser
{
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
     * Parse request data.
     *
     * @return self
     */
    public static function from(RegisterRequest $request)
    {
        return new static($request->all());
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
