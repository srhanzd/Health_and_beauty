<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentIndexRequest;
use App\Http\Requests\AppointmentReserveRequest;
use App\Http\Requests\CancelAppointmentRequest;
use App\Services\Appointment_services\Appointment_get_canceled_service;
use App\Services\Appointment_services\Appointment_get_complete_service;
use App\Services\Appointment_services\Appointment_get_pending_service;
use App\Services\Appointment_services\Appointment_index_service;
use App\Services\Appointment_services\AppointmentReserveService;
use App\Services\Appointment_services\Cancel_appointment_service;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use GeneralTrait;
    private $Appointment_index_service;
    private $Appointment_reserve_service;
    private $Appointment_get_pending_service;
    private $Appointment_get_complete_service;
    private $Appointment_get_canceled_service;
    private $Cancel_appointment_service;
    public function __construct(Appointment_index_service $Appointment_index_service,
                                AppointmentReserveService $Appointment_reserve_service,
                                Appointment_get_pending_service $Appointment_get_pending_service,
                                Appointment_get_complete_service $Appointment_get_complete_service,
                                Appointment_get_canceled_service $Appointment_get_canceled_service,
                                Cancel_appointment_service $Cancel_appointment_service

    )
    {
        $this->Appointment_index_service=$Appointment_index_service;
        $this->Appointment_reserve_service=$Appointment_reserve_service;
        $this->Appointment_get_pending_service=$Appointment_get_pending_service;
        $this->Appointment_get_complete_service=$Appointment_get_complete_service;
        $this->Appointment_get_canceled_service=$Appointment_get_canceled_service;
        $this->Cancel_appointment_service=$Cancel_appointment_service;
    }
    public function index(AppointmentIndexRequest $request){
        try {
        return $this->Appointment_index_service->index($request);
            }
        catch (\Exception $e){
             return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
                             }
    }



    public function reserve(AppointmentReserveRequest $request){
        try {
        return $this->Appointment_reserve_service->reserve($request);
            }
        catch (\Exception $e){
             return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
                             }
    }

    public function get_pending(Request $request){
        try {
        return $this->Appointment_get_pending_service->pending($request);
            }
        catch (\Exception $e){
             return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
                             }
    }
    public function get_complete(Request $request){
        try {
        return $this->Appointment_get_complete_service->complete($request);
            }
        catch (\Exception $e){
             return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
                             }
    }

    public function get_canceled(Request $request){
        try {
        return $this->Appointment_get_canceled_service->canceled($request);
            }
        catch (\Exception $e){
             return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
                             }
    }
    public function cancel_appointment(CancelAppointmentRequest $request){
        try {
        return $this->Cancel_appointment_service->cancel($request);
            }
        catch (\Exception $e){
             return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
                             }
    }
}
