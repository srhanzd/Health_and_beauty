<?php

namespace App\Services\AuthServices;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\GeneralTrait;
use http\Client\Request;
use Illuminate\Support\Facades\Validator;

class LogInServices
{

    use GeneralTrait;
public function LogIn(LoginRequest $request){
    try {
        $input = $request->validated();

        $credentials = $request->only(['name', 'password']);//, 'email'
        if (auth()->guard('user')->attempt($credentials)) {

            config(['auth.guards.api.provider' => 'user']);

            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success = $user;
            $success['token'] = $user->createToken('MyApp', ['user'])->accessToken;

            return $this->returnData('user', $success);
        } else {
            return $this->returnError('E990999', 'invalid user name or password');

        }

    }
    catch
    (\Exception $e){

        return $this->returnError($e->getLine(), $e->getMessage());

    }


}

}
