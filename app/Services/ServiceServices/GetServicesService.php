<?php

namespace App\Services\ServiceServices;

use App\Http\Requests\GetServicesRequest;
use App\Models\Service;
use App\Traits\GeneralTrait;

class GetServicesService
{
    use GeneralTrait;
    public function services(GetServicesRequest  $request){

            $clinic_id=$request->validated();

            try {
                $services = Service::query()->where('IsDeleted', '=', 0)
                    ->where('ClinicId', '=', $clinic_id)
                    ->latest()->paginate(5);

                return $this->returnData('services', $services, 'Services retrieved successfully.', $request->header('lang'));

            }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }

    }
}




