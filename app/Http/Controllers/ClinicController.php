<?php

namespace App\Http\Controllers;

use App\Services\ClinicServices\GetClinicsService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    use GeneralTrait;
    private $GetClinicsService;

    public function __construct(GetClinicsService $getClinicsService)
    {
        $this->GetClinicsService=$getClinicsService;


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
}
