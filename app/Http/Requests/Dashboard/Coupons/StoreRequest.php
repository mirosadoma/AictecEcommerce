<?php

namespace App\Http\Requests\Dashboard\Coupons;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'start_date'            => __('Start Date'),
            'end_date'              => __('End Date'),
            'code'                  => __('Code'),
            'type'                  => __('Type'),
            'value'                 => __('Value'),
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
            'start_date'            => 'required',
            'end_date'              => 'required',
            'code'                  => 'required',
            'type'                  => 'required|not_in:null|'.Rule::in(['amount', 'percentage']),
            'value'                 => 'required|numeric',
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
