<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetCodeConfirmRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthServices\ForgetPasswordService;
use App\Services\AuthServices\ResetCodeConfirmService;
use App\Services\AuthServices\ResetPasswordService;
use App\Traits\GeneralTrait;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Services\AuthServices\LogInServices;
use App\Services\AuthServices\RegisterService;
use App\Services\AuthServices\LogOutService;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    use GeneralTrait;
    private $RegisterService;
    private $LogInService;
    private $LogOutService;
    private $ForgetPassword;
    private $ResetPassword;
    private $ResetCodeConfirm;
    public function __construct(LogInServices $LogInService,RegisterService $RegisterService,LogOutService $LogOutService,ForgetPasswordService $ForgetPassword,ResetPasswordService $ResetPassword,ResetCodeConfirmService $ResetCodeConfirm)
    {
$this->RegisterService=$RegisterService;
$this->LogInService=$LogInService;
$this->LogOutService=$LogOutService;
$this->ForgetPassword=$ForgetPassword;
$this->ResetPassword=$ResetPassword;
$this->ResetCodeConfirm=$ResetCodeConfirm;

    }



    public function PatientRegister(RegisterRequest $request){
        try {
            return $this->RegisterService->Register($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage());

        }
    }
    public function PatientLogin(LoginRequest $request){
        try {

            return $this->LogInService->LogIn($request);
        }
        catch
        (\Exception $e){

            return $this->returnError($e->getLine(), $e->getMessage());

        }
    }





    public function PatientLogout(Request $request){
        try {
          return  $this->LogOutService->LogOut($request);
        }
        catch (\Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage());
        }

    }
    public function PatientForgetPassword(ForgetPasswordRequest $request){
        try {
          return  $this->ForgetPassword->ForgetPassword($request);
        }
        catch (\Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage());
        }

    }
    public function PatientResetCodeConfirm(ResetCodeConfirmRequest $request)
    {
        try {
            return $this->ResetCodeConfirm->CodeConfirm($request);
        } catch (\Exception $exception) {
            return $this->returnError($exception->getCode(), $exception->getMessage());
        }
    }
        public function PatientResetPassword(ResetPasswordRequest $request){
        try {
          return  $this->ResetPassword->ResetPassword($request);
        }
        catch (\Exception $exception){
            return $this->returnError($exception->getCode(),$exception->getMessage());
        }

    }

}
