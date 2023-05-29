<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetServicesRequest;
use App\Services\ServiceServices\GetServicesService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use GeneralTrait;
    private $GetServicesService;

    public function __construct(GetServicesService $GetServicesService)
    {
        $this->GetServicesService=$GetServicesService;


    }


    public function GetServices(GetServicesRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetServicesService->services($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
