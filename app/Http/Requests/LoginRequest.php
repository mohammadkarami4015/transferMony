<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends CustomApiRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::exists('users', 'email')
            ],
            'password' => [
                'required',
                Password::min(8)
            ]
        ];
    }
}
