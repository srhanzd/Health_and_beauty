<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1 ;$i<=3;$i++) {
                Clinic::query()->updateOrCreate(
                    [
                        'Name' => 'Clinic '.$i,
                    ]
                );
            }
    }
}
