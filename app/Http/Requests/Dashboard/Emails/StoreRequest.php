<?php

namespace App\Http\Requests\Dashboard\Emails;

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
            'email_type'            => __('Email Type'),
            'email_clients_type'    => __('Email Clients Type'),
            'clients'               => __('Clients'),
            'lists'                 => __('Lists'),
            'one_client'            => __('Client'),
            'one_list'              => __('List'),
            'content'               => __('Content'),
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
            'email_type'            => 'required',
            'email_clients_type'    => 'required',
            'clients'               => 'required_if:email_type,one_client',
            'lists'                 => 'required_if:email_type,one_list',
            'content'               => 'required',
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
