<?php

namespace App\Http\Requests\Api\Auth;

use App\Support\JsonFormRequest as FormRequest;

class ForgetRequest extends FormRequest
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
        if (is_numeric(request('email_or_phone'))) {
            return [
                'email_or_phone'                 => __('Phone'),
            ];
        } else {
            return [
                'email_or_phone'                 => __('Email'),
            ];
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (is_numeric(request('email_or_phone'))) {
            return [
                'email_or_phone'                 => ['required', 'exists:users,phone', 'regex:/^(009665|9665|\+9665|05|5)?([0-9]){8}$/'],
            ];
        } else {
            return [
                'email_or_phone'                 => ['required', 'exists:users,email', 'email'],
            ];
        }
    }
}
