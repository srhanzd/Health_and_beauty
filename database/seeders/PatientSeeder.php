<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

       // for ($i = 1; $i <= 3; $i++) {
            $user=  User::query()->create([
                'name' => 'Psrhan',// . Str::random(5),
                'first_name' => 'Psrhan',// . Str::random(5),
                'last_name' => 'Pzoyed',// . Str::random(5),
                'phone_number' => $faker->phoneNumber.random_int(1,10),
                'telephone_number' => $faker->phoneNumber.random_int(1,10),
                'email' => 'Psrhan' . '@gmail.com',
                'password' =>  bcrypt('srhan999'),

            ]);
            Patient::query()->create([
                'UserId'=>$user->id,
                'Birthdate'=>Carbon::createFromDate('1999','2','25'),
                'Gender'=>'Male',
                'Address'=>'Dubai',
            ]);
        //}
    }

}
