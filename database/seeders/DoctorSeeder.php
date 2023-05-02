<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 3; $i++) {
          $user=  User::query()->create([
                'name' => 'Dsrhan  ' . Str::random(5),
                'first_name' => 'Dsrhan  ' . Str::random(5),
                'last_name' => 'Dzoyed  ' . Str::random(5),
              'phone_number' => $faker->phoneNumber.random_int(1,10),
              'telephone_number' => $faker->phoneNumber.random_int(1,10),
                'email' => Str::random(5) . '@gmail.com',
                'password' =>  bcrypt('srhan1999'),

            ]);
          Doctor::query()->create([
              'UserId'=>$user->id,
              'ClinicId'=>$i,
              'Degree'=>'Degree '.$i,
              'AboutMe'=>'AboutMe '.$i,
              'Specialization'=>'Specialization '.$i,



          ]);
        }
    }

}
