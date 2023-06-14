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
            $validatedData = $request->validated();
            $user = auth()->user();

            if (isset($validatedData['phone_number'])) {
                $user->phone_number = $validatedData['phone_number'];
            }

            if (isset($validatedData['telephone_number'])) {
                $user->telephone_number = $validatedData['telephone_number'];
            }

            if (isset($validatedData['email'])) {
                $user->email = $validatedData['email'];
            }

            if (isset($validatedData['Address'])) {
                $user->patient->Address = $validatedData['Address'];
            }

            $user->save();
            $user->patient->save();

            return $this->returnSuccessMessage('Profile information updated successfully.', "S000", $request->header('lang'));


        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
