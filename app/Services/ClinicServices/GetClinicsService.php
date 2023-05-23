<?php

namespace App\Services\ClinicServices;

use App\Models\Clinic;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GetClinicsService
{
    use GeneralTrait;

    public function Clinics(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $clinics = Clinic::query()->where('IsDeleted', '=', 0)
                ->latest()->with("images")->paginate(10);//5

            return $this->returnData('clinics', $clinics, 'Clinics retrieved successfully.', $request->header('lang'));

        } catch
        (\Exception $e) {

            return $this->returnError($e->getLine(), $e->getMessage(), $request->header('lang'));

        }

    }
}
