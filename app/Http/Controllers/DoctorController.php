<?php

namespace App\Http\Controllers;

use App\Services\DoctorServices\GetDoctorsService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
     use GeneralTrait;
        private $GetDoctorsService;

        public function __construct(GetDoctorsService $getDoctorsService)
        {
    $this->GetDoctorsService=$getDoctorsService;


        }

    public function GetDoctors(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetDoctorsService->Doctors($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
