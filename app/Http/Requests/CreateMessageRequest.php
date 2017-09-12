<?php

namespace App\Http\Requests;

use App\User;

class CreateMessageRequest extends Request
{
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
        return User::where('username', $this->get('username'))->firstOrFail();
    }
}
