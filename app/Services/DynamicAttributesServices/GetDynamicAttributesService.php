<?php

namespace App\Services\DynamicAttributesServices;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GetDynamicAttributesService
{
    use GeneralTrait;
    public function dynamic_attributes(Request  $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $dynamic_attributes = $user->patient()
                ->where('IsDeleted', 0)
                ->first()
                ->dynamic_attributes_values()
                ->where('IsDeleted', 0)
                ->where('Disable', 0)
                ->with(["dynamic_attribute" => function ($query) {
                    $query->where('IsDeleted', 0)
                        ->where('Disable', 0)
                    ;
                }])
                ->paginate(5);

            return $this->returnData('dynamic_attributes', $dynamic_attributes, 'Dynamic Attributes retrieved successfully.', $request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
