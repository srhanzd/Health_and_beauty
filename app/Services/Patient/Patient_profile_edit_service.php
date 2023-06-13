<?php

namespace App\Services\Patient;

use App\Http\Requests\PatientProfileEditRequest;
use App\Traits\GeneralTrait;

class Patient_profile_edit_service
{
    use GeneralTrait;
    public function profile_edit(PatientProfileEditRequest  $request)
    {
        try {
           $request->validated();
           $user_data=$request->only(['phone_number','telephone_number','email']);
           $patient_data=$request->only(['Address']);
            $user_informations = auth()->user()->update($user_data);
            $user_informations = auth()->user()->patient()->update($patient_data);

            return $this->returnSuccessMessage('Profile information updated successfully.',"S000",$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
