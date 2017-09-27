<?php

namespace App\Http\Requests;

use App\User;

class CreateUserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:140',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|min:3|max:25',
        ];
    }
}
