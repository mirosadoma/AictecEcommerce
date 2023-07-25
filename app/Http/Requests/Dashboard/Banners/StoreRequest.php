<?php

namespace App\Http\Requests\Dashboard\Banners;

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
            'image'                 => __('Image'),
            'link'                  => __('Link'),
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
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'link'              => "required|url",
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
