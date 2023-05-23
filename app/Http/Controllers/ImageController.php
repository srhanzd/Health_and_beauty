<?php

namespace App\Http\Controllers;

use App\Services\ImageServices\GetCenterImagesService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    use GeneralTrait;
    private $GetCenterImagesService;

    public function __construct(GetCenterImagesService $GetCenterImagesService)
    {
        $this->GetCenterImagesService=$GetCenterImagesService;


    }

    public function GetCenterImages(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->GetCenterImagesService->Images($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
