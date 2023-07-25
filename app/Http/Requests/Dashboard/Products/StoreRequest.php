<?php

namespace App\Http\Requests\Dashboard\Products;

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
            'title'                     => 'Title',
            'small_description'         => 'Small Description',
            'description'               => 'Description',
        ];
        $return = [
            'main_image'                => __('Main Image'),
            'images'                    => __('Images'),
            'model'                     => __('Model'),
            'price'                     => __('Price'),
            'old_price'                 => __('Old Price'),
            'quantity'                  => __('Quantity'),
            'category_id'               => __('Category'),
            'brand_id'                  => __('Brand'),
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
            'main_image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'images'                => 'nullable|array',
            'model'                 => 'required',
            'price'                 => 'required|numeric',
            'old_price'             => 'required|numeric',
            'quantity'              => 'required|numeric',
            'category_id'           => 'required|exists:categories,id|not_in:null,0',
            'brand_id'              => 'required|exists:brands,id|not_in:null,0',
        ];
        $lang_rules = [];
        foreach(app_languages() as $key => $value){
            $lang_rules[$key] = [
                $key.".title"               => "required|string|between:2,500",
                $key.".small_description"   => "nullable|string|between:2,100000",
                $key.".description"         => "nullable|string|between:2,10000000",
            ];
        }
        extract($lang_rules, EXTR_PREFIX_SAME, "wddx");
        $rules = array_merge($rules, $ar, $en);
        return $rules;
    }
}
