<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class TransactionRequest extends CustomApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => [
                'required'
            ],
            'type' => [
                'required',
                Rule::in(['account', 'shaba'])
            ],
            'account_number' => [
                Rule::requiredIf($this->type == 'account'),
                'numeric',
            ],
            'shaba_number' => [
                Rule::requiredIf($this->type == 'shaba'),
                'min:16'
            ],
            'description' => [
                'required'
            ],
            'amount' => [
                'required',
                'numeric'
            ]
        ];
    }
}
