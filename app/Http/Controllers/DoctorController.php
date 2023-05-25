<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorAvailabilityRequest;
use App\Services\DoctorServices\GetDoctorAvailabilityService;
use App\Services\DoctorServices\GetDoctorsService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
     use GeneralTrait;
        private $GetDoctorsService;
        private $GetDoctorAvailabilityService;

        public function __construct(GetDoctorsService $getDoctorsService,GetDoctorAvailabilityService $availabilityService)
        {
    $this->GetDoctorsService=$getDoctorsService;
    $this->GetDoctorAvailabilityService=$availabilityService;

        }

    public function GetDoctors(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetDoctorsService->Doctors($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
    public function GetDoctorAvailability(DoctorAvailabilityRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetDoctorAvailabilityService->Availability($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
