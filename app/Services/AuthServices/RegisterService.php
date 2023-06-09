<?php

namespace App\Services\AuthServices;

use App\Http\Requests\RegisterRequest;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Patient;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class RegisterService
{
    use GeneralTrait;
    public function Register(RegisterRequest $request)
    {
        try {
            $input = $request->validated();
            $user = User::create([
                'name' => $request->name,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone_number'=>$request->phone_number,
                'telephone_number'=>$request->telephone_number,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $patient = Patient::query()->create([
                'UserId' => $user->id,
                'Birthdate' => $request['Birthdate'],
                'Gender' => $request['Gender'],
                'Address' => $request['Address'],
            ]);
            $credentials = $request->only(['name', 'email', 'password']);
            if (auth()->guard('user')->attempt($credentials)) {

                config(['auth.guards.api.provider' => 'user']);

                $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
                $success['user'] = $user;
                $success ['token'] = $user->createToken('MyApp', ['user'])->accessToken;
                return $this->returnData('data', $success,'You have successfully registered.',$request->header('lang'));
            } else {
                return $this->returnError('E990999', 'Something went wrong.',$request->header('lang'));

            }

        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage(),$request->header('lang'));

        }



    }


}
