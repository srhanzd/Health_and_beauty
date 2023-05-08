<?php

namespace App\Services\AuthServices;

use App\Http\Requests\ForgetPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\GeneralTrait;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordService
{
    use GeneralTrait;
    public function ForgetPassword(ForgetPasswordRequest $request)
    {
        try {
            $input = $request->validated();
            $email = $request->input('email');
            if (User::query()->where('email', '=', $email)
                ->where('IsDeleted','=',0)
                ->doesntExist()) {
                return $this->returnError(898, 'User dos not exists !!!');
            }
            $token = Str::random(5);
            $old=PasswordReset::query()->where('email','=',$email)
                ->where('IsDeleted','=',0)
            ;
            if($old->get()!=null){
               $old->each(function ($reset) {
                   $reset->IsDeleted = 1;
                   $reset->save();
               });
            }
            PasswordReset::query()->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now()->toDateTimeString()
            ]);
            //send email
            Mail::send('Mails.forget',['token'=>$token],function (\Illuminate\Mail\Message $message) use ($email) {
                $message->to($email);
                $message->subject('Reset your password ');
            });
            return $this->returnSuccessMessage('a password reset code has been sent to your email , please enter the password reset page to reset your password .');
        }
        catch (\Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage());
        }
    }

    }
