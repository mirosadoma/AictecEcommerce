<?php

namespace App\Http\Requests\Api\Auth;

use App\Support\JsonFormRequest as FormRequest;

class RegisterRequest extends FormRequest
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
            'password'              => __('Password'),
            'password_confirmation' => __('Password Confirmation'),
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
            'name'                  => 'required|string|between:2,100',
            'email'                 => 'nullable|email:filter|max:255|unique:users,email',
            'phone'                 => ['required', 'unique:users,phone', 'regex:/^(009665|9665|\+9665|05|5)?([0-9]){8}$/'],
            'password'              => 'required|min:4|max:50',
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }
}
