<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Support\JsonFormRequest as FormRequest;

class CheckCodeRequest extends FormRequest
{
    protected $errorBag = 'form';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'phone'                 => __('Phone'),
            'verification_code'     => __('Verification Code'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'                 => ['required', 'exists:users,phone', 'regex:/^(009665|9665|\+9665|05|5)?([0-9]){8}$/'],
            'verification_code'     => 'required|numeric'
        ];
    }
}
