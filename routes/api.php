<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\passportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('patient/login',[AuthController::class, 'PatientLogin'])->name('Login')->middleware(['BlockUserMiddleware','AuthenticationMiddleware','DBTransactionMiddleware','throttle:authentication','LogMiddleware']);
Route::post('patient/register',[AuthController::class, 'PatientRegister'])->name('UserRegister')->middleware(['AuthenticationMiddleware','DBTransactionMiddleware','LogMiddleware']);
Route::post('patient/forgot_password', [AuthController::class, 'PatientForgetPassword'])->middleware(['DBTransactionMiddleware','LogMiddleware']);;
Route::post('patient/reset_code_confirm', [AuthController::class, 'PatientResetCodeConfirm'])->middleware(['ResetMiddleware','DBTransactionMiddleware','LogMiddleware']);;
Route::post('patient/reset_password', [AuthController::class, 'PatientResetPassword'])->middleware(['ResetMiddleware','DBTransactionMiddleware','LogMiddleware']);;

Route::group( ['prefix' => 'patient','middleware' => ['auth:user-api','scopes:user','DBTransactionMiddleware','LogMiddleware','HistoryMiddleware'] ],function(){
    // authenticated staff routes here
    Route::post('logout',[AuthController::class, 'PatientLogout']);
//    Route::post('patient_info',[AuthController::class, 'PatientInfo']);


});
