<?php

use App\Http\Controllers\AppointmentController;
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
Route::get('patient/reset_code_confirm', [AuthController::class, 'PatientResetCodeConfirm'])->middleware(['ResetMiddleware','LogMiddleware']);//,'DBTransactionMiddleware'
Route::put('patient/reset_password', [AuthController::class, 'PatientResetPassword'])->middleware(['ResetMiddleware','DBTransactionMiddleware','LogMiddleware']);;

Route::group( ['prefix' => 'patient','middleware' => ['auth:user-api','scopes:user','DBTransactionMiddleware','LogMiddleware','HistoryMiddleware'] ],function(){
    // authenticated staff routes here ...
    Route::get('clinic/search',[\App\Http\Controllers\SearchController::class, 'ClinicsSearch'])->name('search-clinic');
    Route::get('service/search',[\App\Http\Controllers\SearchController::class, 'ServicesSearch'])->name('search-service');
    Route::get('doctor/search',[\App\Http\Controllers\SearchController::class, 'DoctorsSearch'])->name('search-doctor');
    Route::get('doctors',[\App\Http\Controllers\DoctorController::class, 'GetDoctors'])->name('doctors');
    Route::get('clinics',[\App\Http\Controllers\ClinicController::class, 'GetClinics'])->name('clinics');
    Route::get('center/images',[\App\Http\Controllers\ImageController::class, 'GetCenterImages'])->name('center-images');
    Route::get('doctor/availability',[\App\Http\Controllers\DoctorController::class, 'GetDoctorAvailability'])->name('doctor-availability');
    Route::get('clinic/doctors',[\App\Http\Controllers\ClinicController::class, 'GetClinicDoctors'])->name('clinic-doctors');
    Route::get('clinic/services',[\App\Http\Controllers\ServiceController::class, 'GetServices'])->name('clinic-services');
    Route::get('appointment/index', [AppointmentController::class,'index'])->name('appointments=index');
    Route::post('appointment/reserve', [AppointmentController::class,'reserve'])->name('reserve');
    Route::get('appointment/pending', [AppointmentController::class,'get_pending'])->name('get-pending');
    Route::get('appointment/complete', [AppointmentController::class,'get_complete'])->name('get-complete');
    Route::get('appointment/canceled', [AppointmentController::class,'get_canceled'])->name('get-canceled');
    Route::put('appointment/cancel', [AppointmentController::class,'cancel_appointment'])->name('cancel-appointment');
    Route::get('profile', [\App\Http\Controllers\PatientController::class,'patient_profile'])->name('profile');
    Route::put('profile/edit', [\App\Http\Controllers\PatientController::class,'patient_profile_edit'])->name('profile-edit');
    Route::get('medical-info', [\App\Http\Controllers\MedicalInfoController::class,'patient_medical_info'])->name('medical-info');
    Route::get('allergies', [\App\Http\Controllers\MedicalInfoController::class,'patient_allergies'])->name('patient-allergies');
    Route::get('immunizations', [\App\Http\Controllers\MedicalInfoController::class,'patient_immunizations'])->name('patient-immunizations');
    Route::get('medicines', [\App\Http\Controllers\MedicalInfoController::class,'patient_medicines'])->name('patient-medicines');
    Route::get('surgeries', [\App\Http\Controllers\MedicalInfoController::class,'patient_surgeries'])->name('patient-surgeries');
    Route::get('prescriptions', [\App\Http\Controllers\PrescriptionController::class,'patient_prescriptions'])->name('patient-prescriptions');
    Route::get('appointment/prescriptions', [\App\Http\Controllers\PrescriptionController::class,'appointment_prescriptions'])->name('appointment-prescriptions');
    Route::get('dynamic_attributes', [\App\Http\Controllers\DynamicController::class,'GetDynamicAttributes'])->name('dynamic-attributes');
    Route::get('notifications', [\App\Http\Controllers\NotificationController::class,'GetNotifications'])->name('notifications');


    Route::get('logout',[AuthController::class, 'PatientLogout']);
//    Route::post('patient_info',[AuthController::class, 'PatientInfo']);


});
