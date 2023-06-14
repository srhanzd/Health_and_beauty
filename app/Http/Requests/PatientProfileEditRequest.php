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
            'phone_number' => 'nullable|unique:users|digits:10',
            'telephone_number' => 'nullable|unique:users|digits_between:7,10',
            'email' => 'nullable|email|unique:users',
            'Address' => 'nullable'

        ];
    }
    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hasAnyField = $this->filled(['phone_number', 'telephone_number', 'email', 'Address']);

            if (!$hasAnyField) {
                $validator->errors()->add('fields', 'Please enter at least one field to update.');
            }
        });
    }
}
