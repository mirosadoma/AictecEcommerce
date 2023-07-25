<?php

namespace App\Http\Requests\Dashboard\Brands;

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
        $langs = [];
        $return = [
            'name'                  => __('Name'),
            'image'                 => __('Image'),
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
            'name'              => "required|string|between:2,500",
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $lang_rules = [];
        foreach(app_languages() as $key => $value){
            $lang_rules[$key] = [];
        }
        extract($lang_rules, EXTR_PREFIX_SAME, "wddx");
        $rules = array_merge($rules, $ar, $en);
        return $rules;
    }
}
