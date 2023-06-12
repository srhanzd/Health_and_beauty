<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentIndexRequest;
use App\Services\Appointment_services\Appointment_index_service;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use GeneralTrait;
    private $Appointment_index_service;
    public function __construct(Appointment_index_service $Appointment_index_service)
    {
        $this->Appointment_index_service=$Appointment_index_service;
    }
    public function index(AppointmentIndexRequest $request){
        try {
        return $this->Appointment_index_service->index($request);
            }
        catch (\Exception $e){
             return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));
                             }
    }
}
