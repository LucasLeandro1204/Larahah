<?php

namespace App\Jobs;

use App\User;
use App\Http\Requests\CreateUserRequest;

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
    public static function from(CreateUserRequest $request): self
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
        $user = new User($this->data);
        $user->save();

        return $user->fresh();
    }
}
