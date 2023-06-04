<?php

namespace App\Services\SearchServices;

use App\Http\Requests\SearchRequest;
use App\Models\Service;
use App\Traits\GeneralTrait;

class ServicesSearchService
{
    use GeneralTrait;
    public function Search(SearchRequest $request){
        try {
            $search_query = $request->validated();
            if($search_query==null){
                return $this->returnError('333','No results match your search request ',$request->header('lang'));

            }

            $services=Service::query()
                    ->where('IsDeleted','=',0)
                    ->latest()->filter($search_query)->get();//->paginate(10);
            if(!$services->isEmpty()){
                return $this->returnData('services',$services,'search results',$request->header('lang'));
            }
            return $this->returnError('333','No results match your search request ',$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
