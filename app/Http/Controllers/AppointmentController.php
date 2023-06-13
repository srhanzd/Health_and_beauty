<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentIndexRequest;
use App\Http\Requests\AppointmentReserveRequest;
use App\Services\Appointment_services\Appointment_index_service;
use App\Services\Appointment_services\AppointmentReserveService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use GeneralTrait;
    private $Appointment_index_service;
    private $Appointment_reserve_service;
    public function __construct(Appointment_index_service $Appointment_index_service,AppointmentReserveService $Appointment_reserve_service)
    {
        $this->Appointment_index_service=$Appointment_index_service;
        $this->Appointment_reserve_service=$Appointment_reserve_service;
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
}
