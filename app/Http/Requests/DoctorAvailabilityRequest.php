<?php

namespace App\Http\Requests;

use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DoctorAvailabilityRequest extends FormRequest
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
            'doctor_id' => 'required',

        ];
    }


    public function failedValidation(Validator $validator)
    {
        // dd($validator->errors());


        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }
    protected function prepareForValidation()
    {
        // Retrieve specific header values
        $doctor_id = $this->header('doctor_id');

        // Set the header values back to the request
        $this->merge([
            'doctor_id' => $doctor_id,

        ]);
    }
}
