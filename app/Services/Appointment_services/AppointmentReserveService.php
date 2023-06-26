<?php

namespace App\Services\Appointment_services;

use App\Events\NewReservation;
use App\Http\Requests\AppointmentReserveRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppointmentReserveService
{
    use GeneralTrait;
    public function reserve(AppointmentReserveRequest $request)
    {

        try {

            $data= array_merge($request->all(),['user_id'=>auth()->id()]);

            Appointment::query()->create($request->all());
            event(new NewReservation($data));

            return $this->returnSuccessMessage('Appointment Reserved successfully.',
                'S000',
                $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }
    }
}
