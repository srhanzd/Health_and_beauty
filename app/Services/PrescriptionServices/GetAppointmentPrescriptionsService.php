<?php

namespace App\Services\PrescriptionServices;

use App\Http\Requests\AppointmentPrescriptionsRequest;
use App\Models\Appointment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class GetAppointmentPrescriptionsService
{
    use GeneralTrait;
    public function prescriptions(AppointmentPrescriptionsRequest  $request): \Illuminate\Http\JsonResponse
    {
        try {
            $appointment_id=$request->validated()['appointment_id'];


            $Appointment=Appointment::query()
                ->where('IsDeleted','=',0)
                ->where('id','=',$appointment_id)
                ->first();
            if ($Appointment) {
                $prescriptions = $Appointment
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
            return $this->returnError('090','No prescriptions found for this appointment !!! ',$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
