<?php

namespace App\Services\MedicalInfoServices;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Patient_allergies_service
{
    use GeneralTrait;
    public function allergies(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $allergies = $user->medical_informations()
                ->where('IsDeleted', 0)
                ->first()
                ->allergies()
                ->where('IsDeleted', 0)
                ->paginate(5);

            return $this->returnData('allergies', $allergies, 'Allergies retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
