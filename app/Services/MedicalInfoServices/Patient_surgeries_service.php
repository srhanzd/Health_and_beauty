<?php

namespace App\Services\MedicalInfoServices;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Patient_surgeries_service
{
    use GeneralTrait;
    public function surgeries(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $surgeries = $user->medical_informations()
                ->where('IsDeleted', 0)
                ->first()
                ->surgeries()
                ->where('IsDeleted', 0)
                ->paginate(5);

            return $this->returnData('surgeries', $surgeries, 'Surgeries retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
