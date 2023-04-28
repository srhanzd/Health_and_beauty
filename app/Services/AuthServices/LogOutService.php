<?php

namespace App\Services\AuthServices;

use App\Traits\GeneralTrait;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogOutService
{
    use GeneralTrait;
    public function LogOut(\Illuminate\Http\Request $request)
    {

        try {

            $tokens = auth()->user()->tokens;
            foreach($tokens as $token) {
                $token->revoke();
                $token->delete();
            }
            return $this->returnSuccessMessage('logout successfully');

        }
        catch (\Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage());
        }
    }

}
