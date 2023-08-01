<?php

namespace App\Http\Requests\Api\Main;

use App\Support\JsonFormRequest as FormRequest;

class ContactUsRequest extends FormRequest
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
            'name'                  => __('Name'),
            'email'                 => __('Email'),
            'phone'                 => __('Phone'),
            'message'               => __('Message'),
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
            'name'                  => 'required|required|string|between:2,100000',
            'email'                 => 'required|email',
            'phone'                 => 'required',
            // 'phone'                 => 'required|digits:10|regex:/^(05)?([0-9]){8}$/',
            'message'               => 'required|string|between:2,1000000000',
        ];
    }
}
