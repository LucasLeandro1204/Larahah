<?php

namespace App\Http\Requests;

use App\User;

class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function getUser(): User
    {
        return User::where('email', $this->get('email'))->firstOrFail();
    }
}
