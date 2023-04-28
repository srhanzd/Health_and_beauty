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


            $token = $request->only(['token']);//, 'email'
            $email = $request->only(['email']);//, 'email'
            $password_reset = PasswordReset::query()->where('email', '=', $email);
            if (User::query()->where('email', '=', $email)->doesntExist()) {
                return $this->returnError(898, 'User dos not exists !!!');
            }
            if ($password_reset->first() == null) {
                return $this->returnError(298, 'please go to forget password page to send code for resting your password');

            }
            if ($password_reset->first()->token != $token['token']) {
                return $this->returnError('777', 'invalid code please go to forget password page to send code for resting your password');
            }
            return $next($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage());

        }
    }
}
