<?php

namespace App\Services\AuthServices;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\GeneralTrait;

class ResetPasswordService
{
    use GeneralTrait;
    public function ResetPassword(ResetPasswordRequest $request){
        try {
            $input = $request->validated();
            $password = $request->input(['password']);//, 'email'
            $email=$request->input(['email']);
            $user=User::query()->where('email', '=', $email)
                ->where('IsDeleted','=',0)
                ->first();
            $user->password=bcrypt($password);
            $user->save();
            $password_reset=PasswordReset::query()->where('email','=',$email)
                ->where('IsDeleted','=',0)

            ;
            $password_reset->update(['IsDeleted'=>1]);
            return $this->returnSuccessMessage('Your password has been changed successfully.',"S000",$request->header('lang'));
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }

    }

}
