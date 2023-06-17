<?php

namespace App\Services\PrescriptionServices;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GetPrescriptionsService
{
    use GeneralTrait;
    public function prescriptions(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $prescriptions = $user->medical_informations()
                ->where('IsDeleted', 0)
                ->first()
                ->prescriptions()
                ->where('IsDeleted', 0)
                ->paginate(5);

            return $this->returnData('prescriptions', $prescriptions, 'Prescriptions retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
