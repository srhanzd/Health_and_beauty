<?php

namespace App\Services\AuthServices;

use App\Http\Requests\LoginRequest;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Image;
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
            $success['user'] = $user;
            $success['user'] ['token'] = $user->createToken('MyApp', ['user'])->accessToken;
            $doctors=Doctor::query()->where('IsDeleted','=',0)
                ->latest()->with("image")->with('user')->paginate(2);//5
            $success['doctors']=$doctors;
            $clinics=Clinic::query()->where('IsDeleted','=',0)
                ->latest()->with("images")->paginate(2);//5
            $success['clinics']=$clinics;
            $images=Image::query()->where('IsDeleted','=',0)
                ->where('LocalImage','=',1)->get();
            $success['center_images']=$images;

            return $this->returnData('data', $success,'You have successfully logged in.',$request->header('lang'));
        } else {
            return $this->returnError('E990999', 'invalid user name or password',$request->header('lang'));

        }

    }
    catch
    (\Exception $e){

        return $this->returnError($e->getLine(), $e->getMessage());

    }


}

}
