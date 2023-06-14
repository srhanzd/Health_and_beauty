<?php

namespace App\Services\Appointment_services;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Appointment_get_canceled_service
{
    use GeneralTrait;
    public function canceled(Request $request)
    {

        try {


            $user=auth()->user();

            $patient=$user->patient;

            $appointments=$patient->appointments()
                ->where('IsDeleted','=',0)
                ->where('Status','=',2)
                ->latest()->paginate(5);
            return $this->returnData('appointments',$appointments
                , 'Canceled Appointments retrieved successfully.', $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }
    }
}
