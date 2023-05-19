<?php

namespace App\Services\AuthServices;

use App\Http\Requests\ResetCodeConfirmRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\GeneralTrait;
use function Symfony\Component\Translation\t;

class ResetCodeConfirmService
{
    use GeneralTrait;
    public function CodeConfirm(ResetCodeConfirmRequest $request)
    {
        try {
            $input = $request->validated();
            $email = $request->only(['email']);//, 'email'
            $token = $request->only(['token']);//, 'email'
            $password_reset=PasswordReset::query()->where('email','=',$email)
                ->where('IsDeleted','=',0)

            ;
            $created_at=$password_reset->first()->created_at;
            $now=now();
            if($now->diffInMinutes($created_at)>60){
                $password_reset->update(['IsDeleted'=>1]);
                return $this->returnError('077','The password reset code has expired. Please go to the Forgot Password page to generate a new code for resetting your password.',$request->header('lang'));
            }
            $success['token']=$request->input(['token']);
            $success['email']=$request->input(['email']);
            return $this->returnData('code_confirm_data',$success,'The code has been confirmed successfully.',$request->header('lang'));

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }

}
