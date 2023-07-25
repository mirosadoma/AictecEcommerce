<?php

namespace App\Http\Requests\Dashboard\Clients;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'name'                  => __('Name'),
            'email'                 => __('Email'),
            'phone'                 => __('Phone'),
            'image'                 => __('Image'),
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
            'name'                  => 'required|string|between:2,100|unique:users,name',
            'email'                 => 'required|email:filter|between:2,200|unique:users,email',
            'phone'                 => 'required|digits:10|regex:/^(05)?([0-9]){8}$/|unique:users,phone',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'password'              => 'required|between:6,255',
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }
}
