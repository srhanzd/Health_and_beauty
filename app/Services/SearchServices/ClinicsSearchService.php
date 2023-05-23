<?php

namespace App\Services\SearchServices;

use App\Http\Requests\SearchRequest;
use App\Models\Clinic;
use App\Traits\GeneralTrait;

class ClinicsSearchService
{
    use GeneralTrait;
    public function Search(SearchRequest $request){
        try {
            $input = $request->validated();

            $clinics=Clinic::query()
                ->where('IsDeleted','=',0)
                ->latest()->filter(request()->only('search_query'))->paginate(10);

            if(!$clinics->isEmpty()){
                return $this->returnData('clinics',$clinics,'search results',$request->header('lang'));
            }
            return $this->returnError('333','No results match your search request ',$request->header('lang'));
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
