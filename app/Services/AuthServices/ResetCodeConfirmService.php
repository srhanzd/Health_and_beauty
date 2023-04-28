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
            $password_reset=PasswordReset::query()->where('email','=',$email);
            $created_at=$password_reset->first()->created_at;
            $now=now();
            if($now->diffInMinutes($created_at)>60){
                $password_reset->delete();
                return $this->returnError('077','the password reset code has been expired , please go to forget password page to send a new code for resting your password');
            }
            $success['token']=$request->input(['token']);
            $success['email']=$request->input(['email']);
           return $this->returnData('code_confirm_data',$success,'the code confirmed successfully');

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage());

        }
    }

}
