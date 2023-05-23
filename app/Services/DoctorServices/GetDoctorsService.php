<?php

namespace App\Services\DoctorServices;

use App\Http\Requests\SearchRequest;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GetDoctorsService
{
    use GeneralTrait;
    public function Doctors(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {

            $doctors=Doctor::query()->where('IsDeleted','=',0)
                ->latest()->with("image")->with('user')->paginate(5);//5

            return $this->returnData('doctors', $doctors, 'Doctors retrieved successfully.', $request->header('lang'));

            }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
