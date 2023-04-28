<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $services=Service::query()->get()->all();
        $service=1;
        $time=Carbon::createFromTime(10,0,0);
        if(now()->isFriday()||now()->isSunday()||$time->isPast()){
            $date=now()->addDay();
        }
        else{
            $date=now();
        }

//        if ($time->isPast()){
//            if($date->addDay()->isFriday()||$date->addDay()->isSunday()){
//                $date=now()->addDays(2);
//            }
//            else{
//                $date=now()->addDay();
//            }
//
//        }
        for ($i=1;$i<=3;$i++){
//        foreach ($services as $service){
              $appointment=  Appointment::query()->create([
                    'PatientId'=>7,
                    'DoctorId'=>$i,
                    'ServiceId'=>$service,
                    'Date'=>$date->toDateString(),
                    'Time'=>Carbon::createFromTime(10,0,0)->toTimeString()
                ]);
              $user=User::query()->where('id','=',7)->first();

             $prescription=   Prescription::query()->create([
                    'AppointmentId'=>$appointment->id,
                    'Symptoms'=>'Symptoms for appointment '. $appointment->id,
                    'Diagnosis'=>'Diagnosis for appointment '. $appointment->id,
                    'MedicalInfoId'=>$user->medical_informations()->value('id'),
                ]);
            Medicine::query()->create([
                'MedicalInfoId'=>$user->medical_informations()->value('id'),
                'PrescriptionId'=>$prescription->id,
                'Name'=>'Paracetamol',
                'Description'=>'Paracetamol Description for  prescription '.$prescription->id
            ]);
            $service+=3;
        }
        }
//    }
}
