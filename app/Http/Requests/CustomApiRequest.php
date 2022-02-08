<?php

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;

class CustomApiRequest extends FormRequest
{

    public function authorize()
    {
        return Auth::check();
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw (new HttpResponseException(
            Response::error($errors, 422)
        ));

    }


}
