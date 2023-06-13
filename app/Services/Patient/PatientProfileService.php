<?php

namespace App\Services\Patient;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PatientProfileService
{
    use GeneralTrait;
    public function profile(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {

            $profile_informations = auth()->user()->load('patient');

            return $this->returnData('profile_informations', $profile_informations, "profile information's retrieved successfully.", $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
