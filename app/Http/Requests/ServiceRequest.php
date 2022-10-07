<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends AbstractFormRequest
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
            'name' => 'required|string',
            'logo' => 'nullable|image|max:2048',
            'country_id' => "required|array",
            'country_id' => 'exists:countries,id',
        ];

        if (request('_method') == 'PUT') {
            $rules['name'] = 'sometimes|string';
            $rules['logo'] = 'sometimes|nullable|image|mimes:png,jpg,svg,jpeg,gif';
            $rules['country_id'] = 'sometimes';
            // $rules['country_id'] = 'sometimes|exists:countries,id';
        }
        return $rules;
    }
}
