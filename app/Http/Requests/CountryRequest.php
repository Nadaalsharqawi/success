<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends AbstractFormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'short_code'=>'required|min:0',
            'logo'=>'sometimes|image|mimes:png,jpg,svg,jpeg,gif',
        ];

        if(request('_method' )== 'PUT'){
            $rules['logo'] = 'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif';
        }

        return $rules;
    }
}
