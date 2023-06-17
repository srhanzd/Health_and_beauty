<?php

namespace App\Http\Controllers;

use App\Services\MedicalInfoServices\Patient_allergies_service;
use App\Services\MedicalInfoServices\Patient_immunizations_service;
use App\Services\MedicalInfoServices\Patient_medical_info_service;
use App\Services\MedicalInfoServices\Patient_medicines_service;
use App\Services\MedicalInfoServices\Patient_surgeries_service;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class MedicalInfoController extends Controller
{
    use GeneralTrait;
    private $Patient_medical_info_service;
    private $Patient_allergies_service;
    private $Patient_immunizations_service;
    private $Patient_medicines_service;
    private $Patient_surgeries_service;
    public function __construct(Patient_medical_info_service $Patient_medical_info_service,
                                Patient_allergies_service $Patient_allergies_service,
                                Patient_immunizations_service $Patient_immunizations_service,
                                Patient_medicines_service $Patient_medicines_service,
                                Patient_surgeries_service $Patient_surgeries_service)
    {
        $this->Patient_medical_info_service=$Patient_medical_info_service;
        $this->Patient_allergies_service=$Patient_allergies_service;
        $this->Patient_immunizations_service=$Patient_immunizations_service;
        $this->Patient_medicines_service=$Patient_medicines_service;
        $this->Patient_surgeries_service=$Patient_surgeries_service;
    }
    public function patient_medical_info(Request $request){
        try {
            return $this->Patient_medical_info_service->medical_info($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
    public function patient_allergies(Request $request){
        try {
            return $this->Patient_allergies_service->allergies($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
    public function patient_immunizations(Request $request){
        try {
            return $this->Patient_immunizations_service->immunizations($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
    public function patient_medicines(Request $request){
        try {
            return $this->Patient_medicines_service->medicines($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
    public function patient_surgeries(Request $request){
        try {
            return $this->Patient_surgeries_service->surgeries($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
}
