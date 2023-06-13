<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PatientProfileEditRequest extends FormRequest
{
    use  GeneralTrait;
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
        return [
                        'phone_number' => 'required|unique:users|digits:10',
                        'telephone_number' => 'required|unique:users|digits_between:7,10',
                        'email' => 'required|email|unique:users',
                        'Address' => 'required',
        ];
    }
    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }
}
