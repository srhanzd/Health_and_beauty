<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Secretary;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SecretarySeeder extends Seeder
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
                'name' => 'Srahaf' . Str::random(5),
                'first_name' => 'Srahaf' . Str::random(5),
                'last_name' => 'Szoyed' . Str::random(5),
                'phone_number' => $faker->phoneNumber.random_int(1,10),
                'telephone_number' => $faker->phoneNumber.random_int(1,10),
                'email' => Str::random(5) . '@gmail.com',
                'password' =>  bcrypt('srhan1999'),

            ]);
            Secretary::query()->create([
                'UserId'=>$user->id,
                'ClinicId'=>$i,
            ]);
        }
    }

}
