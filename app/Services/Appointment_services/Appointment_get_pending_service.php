<?php

namespace App\Services\Appointment_services;

use App\Models\Appointment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Appointment_get_pending_service
{
    use GeneralTrait;
    public function pending(Request $request)
    {

        try {


            $user=auth()->user();

            $patient=$user->patient;

            $appointments=$patient->appointments()
                ->where('IsDeleted','=',0)
                ->where('Status','=',0)
                ->latest()
                ->with(["doctor" => function ($query) {
                    $query->where('IsDeleted', 0)
                        ->with(["user" => function ($query) {
                            $query->where('IsDeleted', 0);
                        }])

                    ;
                }]) ->with(["service" => function ($query) {
                    $query->where('IsDeleted', 0)
                        ->with(["clinic" => function ($query) {
                            $query->where('IsDeleted', 0);
                        }])

                    ;
                }])->paginate(5);
            return $this->returnData('appointments',$appointments
                , 'Pending Appointments retrieved successfully.', $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }
    }
}
