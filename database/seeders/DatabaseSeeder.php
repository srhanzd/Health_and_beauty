<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  \App\Models\User::factory(10)->create();
        $this->call(WorkingDaysSeeder::class);
        $this->call(ClinicSeeder::class);
//        $this->call(DoctorSeeder::class);
//        $this->call(SecretarySeeder::class);
//        $this->call(DoctorWorkingHoursSeeder::class);
//        $this->call(SecretaryWorkingHoursSeeder::class);
//        $this->call(PatientSeeder::class);
//        $this->call(MedicalInfoSeeder::class);
//        $this->call(NotificationsSeeder::class);
//        $this->call(ImagesSeeder::class);
//        $this->call(ServicesSeeder::class);
//        $this->call(AppointmentsSeeder::class);
        $this->call(OperationSeeder::class);
        $this->call(DataTypeSeeder::class);
    }
}
