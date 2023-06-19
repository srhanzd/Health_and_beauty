<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppointmentPrescriptionsRequest extends FormRequest
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
            'appointment_id' => 'required',

        ];
    }



    public function failedValidation(Validator $validator)
    {


        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }


    protected function prepareForValidation()
    {
        // Retrieve specific header values
        $appointment_id = $this->header('appointment_id');

        // Set the header values back to the request
        $this->merge([
            'appointment_id' => $appointment_id

        ]);
        $Appointment=Appointment::query()
            ->where('IsDeleted','=',0)
            ->where('id','=',$appointment_id)
            ->first();
        if($Appointment){
            $Appointment_patient=$Appointment->patient->id;
        }
        else
            $Appointment_patient=-1;
        if($Appointment_patient!=auth()->user()->patient->id){
            if($this->header('lang')=='ar')
                abort(422, $this->translate('Invalid  Appointment'));
            else
                abort(422, 'Invalid  Appointment');
        }
    }
}
