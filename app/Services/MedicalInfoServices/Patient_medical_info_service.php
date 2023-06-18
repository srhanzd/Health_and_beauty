<?php

namespace App\Services\MedicalInfoServices;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Patient_medical_info_service
{
    use GeneralTrait;
    public function medical_info(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {

                $user = auth()->user();

                $medical_info = $user->medical_informations()
                    ->where('IsDeleted', 0)
                    ->first();

            if ($medical_info!=null) {
                return $this->returnData('medical_info', $medical_info, 'Medical Info retrieved successfully.', $request->header('lang'));
            }
            return $this->returnError('090','Your medical record has not ben created yet !!! ',$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
