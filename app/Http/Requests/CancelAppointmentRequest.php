<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Traits\GeneralTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CancelAppointmentRequest extends FormRequest
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
            'AppointmentId'=> 'required',
            'Notification_token'=> 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnError(000,$validator->errors()->first(),$this->header('lang')));
    }


    protected function prepareForValidation()
    {
        $this->is_Valid();


    }


    private function is_Valid()
    {
        $user=auth()->user();

        $patient=$user->patient;
        $patient_id=$patient->id;
        $appointment=Appointment::query()
            ->where('IsDeleted','=',0)
            ->where('Status','=',0)
            ->where('id','=',$this->input('AppointmentId'))
            ->first();
        if(!$appointment){
            if($this->header('lang')=='ar')
                abort(422, $this->translate('Invalid  Appointment'));
            else
                abort(422, 'Invalid  Appointment');
        }
        // if the doctor is cancel the appointment from my back system we should consider this in if condition here
        if($appointment->PatientId!=$patient_id){
            if($this->header('lang')=='ar')
                abort(422, $this->translate('Invalid  Request'));
            else
                abort(422, 'Invalid  Request');
        }

    }
    }
