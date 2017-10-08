<?php

namespace App\Http\Requests;

use App\User;

class CreateMessageRequest extends Request
{

    /**
     * The request user.
     *
     * @return User
     */
    protected $user;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required',
            'username' => 'required',
        ];
    }

    public function getUser(): User
    {
        return $this->user ?: $this->user = User::where('username', $this->get('username'))->firstOrFail();
    }
}
