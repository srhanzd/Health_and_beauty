<?php

namespace App\Services\MedicalInfoServices;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class Patient_medicines_service
{
    use GeneralTrait;
    public function medicines(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $medical_inf = $user->medical_informations();
            if ($medical_inf) {

                $medicines = $medical_inf
                    ->where('IsDeleted', 0)
                    ->first()
                    ->medicines()
                    ->where('IsDeleted', 0)
                    ->paginate(5);

                return $this->returnData('medicines', $medicines, 'Medicines retrieved successfully.', $request->header('lang'));
            }
            return $this->returnError('090','Your medical record has not ben created yet !!! ',$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
