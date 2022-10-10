<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends AbstractFormRequest
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
            'country_id' => 'required|exists:countries,id',
        ];

        if(request('_method' )== 'PUT'){
            $rules['name_ar'] = 'required|string';
            $rules['name_en'] = 'required|string';
            $rules['country_id'] = 'sometimes|exists:countries,id';
        }

        return $rules;
    }
}
