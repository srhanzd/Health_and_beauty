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
            $user=User::query()->where('email', '=', $email)->first();
            $user->password=bcrypt($password);
            $user->save();
            $password_reset=PasswordReset::query()->where('email','=',$email);
            $password_reset->delete();
            return $this->returnSuccessMessage('000','Your password has been changed successfully.');
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage());

        }

    }

}
