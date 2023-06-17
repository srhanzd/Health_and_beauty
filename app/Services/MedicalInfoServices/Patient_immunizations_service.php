<?php

namespace App\Services\MedicalInfoServices;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Patient_immunizations_service
{
    use GeneralTrait;
    public function immunizations(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $immunizations = $user->medical_informations()
                ->where('IsDeleted', 0)
                ->first()
                ->immunizations()
                ->where('IsDeleted', 0)
                ->paginate(5);

            return $this->returnData('immunizations', $immunizations, 'Immunizations retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
