<?php

namespace App\Http\Controllers;

use App\Services\MedicalInfoServices\Patient_medical_info_service;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class MedicalInfoController extends Controller
{
    use GeneralTrait;
    private $Patient_medical_info_service;
    public function __construct(Patient_medical_info_service $Patient_medical_info_service)
    {
        $this->Patient_medical_info_service=$Patient_medical_info_service;
    }
    public function patient_medical_info(Request $request){
        try {
            return $this->Patient_medical_info_service->medical_info($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
}
