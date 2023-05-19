<?php

namespace App\Http\Middleware;

use App\Models\PasswordReset;
use App\Models\User;
use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;

class ResetMiddleware
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            if($request->method()=='GET'){
                $token = $request->header('token');
                $email = $request->header('email');
            }
            else {
                $token = $request->only(['token'])['token'];//, 'email'
                $email = $request->only(['email']);//, 'email'
            }

            $password_reset = PasswordReset::query()->where('email', '=', $email)
                ->where('IsDeleted','=',0)
            ;
            if (User::query()->where('email', '=', $email)
                ->where('IsDeleted','=',0)
                ->doesntExist()) {
                return $this->returnError(898, 'User dos not exists !!!',$request->header('lang'));
            }
            if ($password_reset->first() == null) {
                return $this->returnError(298, 'Please go to the "Forgot Password" page to send a code for resetting your password.',$request->header('lang'));

            }
            if ($password_reset->first()->token != $token) {
                return $this->returnError('777', 'Invalid code. Please go to the "Forgot Password" page to send a code for resetting your password.',$request->header('lang'));
            }
            return $next($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }
    }
}
