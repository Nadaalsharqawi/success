<?php

namespace App\Http\Requests;

use App\Http\Traits\ResponseTraits;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

abstract class AbstractFormRequest extends FormRequest
{
    use ResponseTraits;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if($this->wantsJson()){
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                // $this->prepare_response(true, $validator->errors()->first(), __('validation.failed'), null, 422)
                response()->json(['status'=>0, 'code'=>422 ,  'message'=>$validator->errors()->first() , 'data'=>null] , 422)
            );
        }else{
            parent::failedValidation($validator);
        }
    }
}
