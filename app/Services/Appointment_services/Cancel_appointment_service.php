<?php

namespace App\Services\Appointment_services;

use App\Http\Requests\CancelAppointmentRequest;
use App\Models\Appointment;
use App\Traits\GeneralTrait;

class Cancel_appointment_service
{
    use GeneralTrait;
    public function cancel(CancelAppointmentRequest $request)
    {

        try {


           $appointment_id=$request->validated()['AppointmentId'];

            $appointment=Appointment::query()
                ->where('IsDeleted','=',0)
                ->where('Status','=',0)
                ->where('id','=',$appointment_id)
                ->first();
            $appointment->Status=2;
            $appointment->save();
            return $this->returnSuccessMessage(
                'Appointment Canceled successfully.','S000', $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }
    }

}
