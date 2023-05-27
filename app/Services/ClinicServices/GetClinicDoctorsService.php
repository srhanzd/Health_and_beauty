<?php

namespace App\Services\ClinicServices;

use App\Http\Requests\ClinicDoctorsRequest;
use App\Models\Doctor;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GetClinicDoctorsService
{
use GeneralTrait;
    public function Doctors(ClinicDoctorsRequest  $request): \Illuminate\Http\JsonResponse
    {
        $clinic_id=$request->validated()['clinic_id'];

        try {
            $doctors=Doctor::query()->where('IsDeleted','=',0)
                ->where('ClinicId','=',$clinic_id)
                ->latest()->with("image")->with('user')->paginate(5);

            return $this->returnData('doctors', $doctors, 'Doctors retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }



}
