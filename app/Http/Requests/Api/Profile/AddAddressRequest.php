<?php

namespace App\Http\Requests\Api\Profile;

use App\Support\JsonFormRequest as FormRequest;

class AddAddressRequest extends FormRequest
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
            'full_name'             => __('Full Name'),
            'phone'                 => __('Phone'),
            'street_address'        => __('Street Address'),
            'building_number'       => __('Building Number'),
            'floor_number'          => __('Floor Number'),
            'postal_code'           => __('Postal Code'),
            'city_id'               => __('City'),
            'district_id'           => __('District'),
            'google_address'        => __('Google Address'),
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
            'full_name'             => 'nullable|string|between:2,100',
            'phone'                 => ['required', 'unique:users,phone,'.\Auth::guard('api')->user()->id, 'regex:/^(009665|9665|\+9665|05|5)?([0-9]){8}$/'],
            'street_address'        => 'required',
            'building_number'       => 'required',
            'floor_number'          => 'required',
            'postal_code'           => 'required',
            'city_id'               => 'required|numeric|exists:cities,id',
            'district_id'           => 'required|numeric|exists:districts,id',
            'google_address'        => 'required|string',
        ];
    }
}
