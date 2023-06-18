<?php

namespace App\Http\Controllers;

use App\Services\DynamicAttributesServices\GetDynamicAttributesService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    use GeneralTrait;
    private $GetDynamicAttributesService;

    public function __construct(GetDynamicAttributesService $GetDynamicAttributesService)
    {
        $this->GetDynamicAttributesService=$GetDynamicAttributesService;


    }

    public function GetDynamicAttributes(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetDynamicAttributesService->dynamic_attributes($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
