<?php

namespace App\Services\SearchServices;

use App\Http\Requests\SearchRequest;
use App\Models\Doctor;
use App\Models\User;
use App\Traits\GeneralTrait;

class DoctorsSearchService
{
    use GeneralTrait;
    public function Search(SearchRequest $request){
        try {
            $search_query = $request->validated();
            if($search_query==null){
                return $this->returnError('333','No results match your search request ',$request->header('lang'));

            }

            $users=User::query()
                ->where('IsDeleted','=',0)
                ->latest()->filter($search_query)->with('doctor')->get();//->paginate(10);
            if(!$users->isEmpty()) {
                $users = $users->reject(function ($user) {
                    return $user->doctor === null;
                });
            }
            if(!$users->isEmpty()){
                return $this->returnData('doctors',$users,'search results',$request->header('lang'));//$users[0]->doctor
            }
            $doctors=Doctor::query()
                ->where('IsDeleted','=',0)
                ->latest()->filter($search_query)
                ->with('user')->get();//->paginate(5);
            if(!$doctors->isEmpty()){
                return $this->returnData('doctors',$doctors,'search results',$request->header('lang'));
            }
            return $this->returnError('333','No results match your search request ',$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }


}
