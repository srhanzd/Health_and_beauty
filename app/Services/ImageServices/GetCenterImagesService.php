<?php

namespace App\Services\ImageServices;

use App\Models\Image;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GetCenterImagesService
{
    use GeneralTrait;
    public function Images(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {

            $images=Image::query()->where('IsDeleted','=',0)
                ->where('LocalImage','=',1)->get();

            return $this->returnData('images', $images, 'Images retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }


}
