<?php

namespace App\Http\Requests\Api\Profile;

use App\Support\JsonFormRequest as FormRequest;

class ProfileRequest extends FormRequest
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
            'name'                  => 'nullable|string|between:2,100',
            'email'                 => 'nullable|email|max:255|unique:users,email,'.\Auth::guard('api')->user()->id,
            'phone'                 => ['required', 'unique:users,phone,'.\Auth::guard('api')->user()->id, 'regex:/^(009665|9665|\+9665|05|5)?([0-9]){8}$/'],
        ];
    }
}
