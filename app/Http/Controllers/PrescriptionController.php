<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentPrescriptionsRequest;
use App\Services\PrescriptionServices\GetAppointmentPrescriptionsService;
use App\Services\PrescriptionServices\GetPrescriptionsService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    use GeneralTrait;
    private $GetPrescriptionsService;
    private $GetAppointmentPrescriptionsService;

    public function __construct(GetPrescriptionsService $GetPrescriptionsService,
                                GetAppointmentPrescriptionsService $GetAppointmentPrescriptionsService)

    {
        $this->GetPrescriptionsService=$GetPrescriptionsService;
        $this->GetAppointmentPrescriptionsService=$GetAppointmentPrescriptionsService;


    }

    public function patient_prescriptions(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetPrescriptionsService->prescriptions($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
    public function appointment_prescriptions(AppointmentPrescriptionsRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetAppointmentPrescriptionsService->prescriptions($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
