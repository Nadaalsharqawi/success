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
            'expertise_id' => 'sometimes|exists:expertises,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'status' => 'in:new,utilizes',
            'delivery_date' => 'required|date',
            'description' => 'string' ,
            'price' => 'required|integer|min:0',

        ];

        if(request('_method' )== 'PUT'){
            $rules['name_ar'] = 'required|string';
            $rules['name_en'] = 'required|string';
            $rules['expertise_id'] = 'sometimes|exists:expertises,id';
            $rules['image'] = 'nullable|image|mimes:jpeg,jpg,png,gif';
            $rules['status'] = 'in:new,utilizes';
            $rules['delivery_date'] = 'required|date';
            $rules['description'] = 'string' ;
            $rules['price'] = 'required|integer|min:0';
        }

        return $rules;
    }
}
