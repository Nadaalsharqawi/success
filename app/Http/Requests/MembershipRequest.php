<?php

namespace App\Http\Requests;

class MembershipRequest extends AbstractFormRequest
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
            'name_membership' => 'required|string',
            'membership_value' => 'required|numeric',
            'eligibility_type' => 'required|in:month,three_months,six_months,year',
            'country_id' => 'required|array',
            'country_id' => 'exists:countries,id',
            'service_id' => 'required|exists:services,id',
        ];

        if (request('_method') == 'PUT') {
            $rules['name_membership'] = 'sometimes|string';
            $rules['membership_value'] = 'sometimes|numeric';
            $rules['eligibility_type'] = 'sometimes|in:month,three_months,six_months,year';
            $rules['country_id'] = 'sometimes|array';
            $rules['country_id'] = 'exists:countries,id';
            $rules['service_id'] = 'sometimes|exists:services,id';
        }

        return $rules;
    }
}
