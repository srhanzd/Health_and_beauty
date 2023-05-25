<?php

namespace App\Services\DoctorServices;

use App\Http\Requests\DoctorAvailabilityRequest;
use App\Models\Doctor;
use App\Models\DoctorWorkingHour;
use App\Traits\GeneralTrait;

class GetDoctorAvailabilityService
{

    use GeneralTrait;
    public function Availability(DoctorAvailabilityRequest  $request): \Illuminate\Http\JsonResponse
    {
        $doctor_id=$request->validated()['doctor_id'];
        try {

           $Availability=DoctorWorkingHour::query()
               ->where('IsDeleted','=',0)
               ->where('Off','=',0)
               ->where('DoctorId','=',$doctor_id)
               ->with("working_day")
               ->where('IsDeleted','=',0)
               ->where('Off','=',0)->get();

            return $this->returnData('Availability', $Availability, 'Doctor Availability retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
