<?php

namespace App\Services\Appointment_services;

use App\Events\CancelReservation;
use App\Http\Requests\CancelAppointmentRequest;
use App\Models\Appointment;
use App\Traits\GeneralTrait;
use Carbon\Carbon;

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

            $date = Carbon::parse($appointment->Date)->toDateString();
            $time = Carbon::parse($appointment->Time)->toTimeString();

            $data =  ['user_id' => $appointment->patient->user->id, 'Date' => $date, 'Time' => $time];
            event(new CancelReservation($data));
            return $this->returnSuccessMessage(
                'Appointment Canceled successfully.','S000', $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }
    }

}
