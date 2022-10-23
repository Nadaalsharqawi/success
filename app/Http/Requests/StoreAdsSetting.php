<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdsSetting extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'duration_status' => 'required',
            // 'date_publication' => 'required_if:duration_status,',
            // 'duration' => 'required|date|after:date_publication',
            'country_id' => 'required|array',
            'country_id' => 'exists:countries,id',
        ];
    }
}
