<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientProfileEditRequest;
use App\Services\Patient\Patient_profile_edit_service;
use App\Services\Patient\Patient_profile_service;
use App\Services\Patient\PatientProfileService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    use GeneralTrait;
    private $Patient_profile_service;
    private $Patient_profile_edit_service;
    public function __construct(PatientProfileService $Patient_profile_service,Patient_profile_edit_service $Patient_profile_edit_service)
    {
        $this->Patient_profile_service=$Patient_profile_service;
        $this->Patient_profile_edit_service=$Patient_profile_edit_service;
    }
    public function patient_profile(Request $request){
        try {
            return $this->Patient_profile_service->profile($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
    public function patient_profile_edit(PatientProfileEditRequest $request){
        try {
            return $this->Patient_profile_edit_service->profile_edit($request);
        }
        catch (\Exception $e){
            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
        }
    }
}
