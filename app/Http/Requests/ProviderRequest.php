<?php

namespace App\Http\Requests;

class ProviderRequest extends AbstractFormRequest
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
            'image' => 'sometimes|image',
            'name_place' => 'required|string',
            'location' => 'required|string',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'show_phone' => 'required',
            'whatsapp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'show_whatsapp' => 'required',
            'fac' => 'required|string',
            'ins' => 'required|string',
            'snap' => 'required|string',
            'country_id' => 'required|array',
            'country_id' => 'exists:countries,id',
            'service_id' => 'required|array',
            'service_id' => 'exists:services,id',
        ];

        if (request('_method') == 'PUT') {
            $rules['country_id'] = 'sometimes|array';
            $rules['country_id'] = 'exists:countries,id';
            $rules['service_id'] = 'sometimes|array';
            $rules['service_id'] = 'exists:services,id';
        }

        return $rules;
    }
}
