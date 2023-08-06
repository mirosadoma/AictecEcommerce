<?php

namespace App\Http\Requests\Api\Orders;

use App\Support\JsonFormRequest as FormRequest;

class CheckOutRequest extends FormRequest
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
            'address_id'                => __('Address'),
            'payment_method_used'       => __('Payment Method Used'),
            'payment_method'            => __('Payment Method'),
            'wallet_used'               => __('Wallet Used'),
            'products'                  => __('Products'),
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
            'address_id'            => 'required|exists:addressess,id',
            'payment_method_used'   => 'nullable',
            'payment_method'        => 'required_if:payment_method_used,true',
            'wallet_used'           => 'nullable',
            'products'              => 'required|array',
        ];
    }
}
