<?php

namespace App\Http\Requests\Dashboard\Settings\DistrictSales;

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
        $langs = [
            'title'                 => 'Title',
        ];
        $return = [
            'phone'                 => __('Phone'),
        ];
        foreach(app_languages() as $key=>$value) {
            foreach($langs as $K=>$V) {
                $return[$key.".".$K] = __($value['name']. " " .$V);
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
            'phone'             => 'required',
        ];
        $lang_rules = [];
        foreach(app_languages() as $key => $value){
            $lang_rules[$key] = [
                $key.".title"   => "required|string|between:2,500",
            ];
        }
        extract($lang_rules, EXTR_PREFIX_SAME, "wddx");
        $rules = array_merge($rules, $ar, $en);
        return $rules;
    }
}
