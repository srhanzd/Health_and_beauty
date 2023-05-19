<?php

namespace App\Http\Controllers;


use App\Http\Requests\SearchRequest;
use App\Services\SearchServices\ClinicsSearchService;
use App\Services\SearchServices\DoctorsSearchService;
use App\Services\SearchServices\ServicesSearchService;
use App\Traits\GeneralTrait;

class SearchController extends Controller
{
    use GeneralTrait;
    private $ClinicsSearchService;
    private $ServicesSearchService;
    private $DoctorsSearchService;
    public function __construct(ClinicsSearchService $ClinicsSearchService,ServicesSearchService $ServicesSearchService,DoctorsSearchService $DoctorsSearchService) {
               $this->ClinicsSearchService=$ClinicsSearchService ;
               $this->ServicesSearchService=$ServicesSearchService;
               $this->DoctorsSearchService=$DoctorsSearchService;
    }
    public function ClinicsSearch(SearchRequest $request){
        try {
            return $this->ClinicsSearchService->Search($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
    public function ServicesSearch(SearchRequest $request){
        try {
            return $this->ServicesSearchService->Search($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
    public function DoctorsSearch(SearchRequest $request){
        try {
            return $this->DoctorsSearchService->Search($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }







}

