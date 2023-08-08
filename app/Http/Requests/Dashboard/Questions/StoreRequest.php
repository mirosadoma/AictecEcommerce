<?php

namespace App\Http\Requests\Dashboard\Questions;

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
            'question'                  => 'Question',
            'answer'                    => 'Answer',
        ];
        $return = [ ];
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
        $rules = [];
        $lang_rules = [];
        foreach(app_languages() as $key => $value){
            $lang_rules[$key] = [
                $key.".question"        => "required|string|between:2,100000",
                $key.".answer"          => "required|string|between:2,100000000",
            ];
        }
        extract($lang_rules, EXTR_PREFIX_SAME, "wddx");
        $rules = array_merge($rules, $ar, $en);
        return $rules;
    }
}
