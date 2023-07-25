<?php

namespace App\Http\Requests\Dashboard\Banks;

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
        $langs = [
            'name'                  => 'Name',
        ];
        $return = [
            'iban'                  => __('Iban'),
            'account_number'        => __('Account Number'),
            'account_owner'         => __('Account Owner'),
        ];
        foreach(app_languages() as $key=>$value) {
            if (count($langs)) {
                foreach($langs as $K=>$V) {
                    $return[$key.".".$K] = __($value['name']. " " .$V);
                }
            }
        }
        return $return;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'iban'                  => 'required|min:24|max:24',
            'account_number'        => 'required|numeric|digits_between:2,20',
            'account_owner'         => 'required|string|between:2,1000'
        ];
        $lang_rules = [];
        foreach(app_languages() as $key => $value){
            $lang_rules[$key] = [
                $key.".name"        => "required|string|between:2,500",
            ];
        }
        extract($lang_rules, EXTR_PREFIX_SAME, "wddx");
        $rules = array_merge($rules, $ar, $en);
        return $rules;
    }
}
