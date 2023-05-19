<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MedicalInfoRequest extends FormRequest
{
    use GeneralTrait;
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

            'Height' => 'required',
            'BGroup' => 'required',
            'Pulse' => 'required',
            'Allergy' => 'required',
            'Weight' => 'required',
            'BPressure' => 'required',
            'Respiration' => 'required',
            'Diet' => 'required'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors());


        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }
}
