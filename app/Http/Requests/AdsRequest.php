<?php

namespace App\Http\Requests;

class AdsRequest extends AbstractFormRequest
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
            'body' => 'required|string',
            'image' => 'required|image',
            'date_publication' => 'required|date|after:yesterday',
            'date_expiry' => 'required|date|after:date_publication',
            'country_id' => 'required|array',
            'country_id' => 'exists:countries,id',
            'service_id' => 'required|array',
            'service_id' => 'exists:services,id',
        ];

        if (request('_method') == 'PUT') {
            $rules['date_publication'] = 'sometimes|date|date|after:yesterday';
            $rules['date_expiry'] = 'sometimes|date|after:date_publication';
            $rules['country_id'] = 'sometimes|array';
            $rules['country_id'] = 'exists:countries,id';
            $rules['service_id'] = 'sometimes|array';
            $rules['service_id'] = 'exists:services,id';
        }

        return $rules;
    }
}
