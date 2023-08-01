<?php

namespace App\Http\Requests\Api\Profile;

use App\Support\JsonFormRequest as FormRequest;

class NewPasswordRequest extends FormRequest
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
            'old_password'          => __('Old Password'),
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
            'old_password'          => 'required|min:4|max:50',
            'password'              => 'required|min:4|max:50',
            'password_confirmation' => 'required_with:password|same:password'
        ];
    }
}
