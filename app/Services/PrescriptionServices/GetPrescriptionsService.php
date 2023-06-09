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
            $medical_info = $user->medical_informations()
                ->where('IsDeleted', 0)
                ->first();
            if ($medical_info) {
                $prescriptions = $user->medical_informations()
                    ->where('IsDeleted', 0)
                    ->first()
                    ->prescriptions()
                    ->where('IsDeleted', 0)
                    ->latest()
                    ->with(["appointment" => function ($query) {
                        $query->where('IsDeleted', 0)
                            ->with(["doctor" => function ($query) {
                                $query->where('IsDeleted', 0)
                                    ->with(["user" => function ($query) {
                                        $query->where('IsDeleted', 0);
                                    }]);
                            }]);
                    }])
                    ->with(["medicines" => function ($query) {
                        $query->where('IsDeleted', 0);
                    }])
                    ->paginate(7);
                if($prescriptions->isEmpty()){
                    return $this->returnError('090','No prescriptions found for this appointment !!! ',$request->header('lang'));

                }
                return $this->returnData('prescriptions', $prescriptions, 'Prescriptions retrieved successfully.', $request->header('lang'));

            }
            return $this->returnError('090','No prescriptions found for you !!! ',$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
