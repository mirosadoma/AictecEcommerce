<?php

namespace App\Http\Requests\Dashboard\Companies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'company_name'          => __('Company Name'),
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
        $rules = [
            'name'                  => 'required|string|between:2,100|unique:users,name,'.$this->company,
            'company_name'          => 'required|string|between:2,100',
            'email'                 => 'required|email:filter|between:2,200|unique:users,email,'.$this->company,
            'phone'                 => 'required|digits:10|regex:/^(05)?([0-9]){8}$/|unique:users,phone,'.$this->company,
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'password'              => 'nullable|min:5|max:255',
            'password_confirmation' => 'required_with:password|same:password',
        ];
        return $rules;
    }
}
