<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClinicDoctorsRequest;
use App\Services\ClinicServices\GetClinicDoctorsService;
use App\Services\ClinicServices\GetClinicsService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    use GeneralTrait;
    private $GetClinicsService;
    private $GetClinicDoctorsService;

    public function __construct(GetClinicsService $getClinicsService,GetClinicDoctorsService $clinicDoctorsService)
    {
        $this->GetClinicsService=$getClinicsService;
        $this->GetClinicDoctorsService=$clinicDoctorsService;


    }

    public function GetClinics(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetClinicsService->Clinics($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

    public function GetClinicDoctors(ClinicDoctorsRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetClinicDoctorsService->Doctors($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
