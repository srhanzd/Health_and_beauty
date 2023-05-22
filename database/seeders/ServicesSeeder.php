<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clinics=Clinic::query()->get()->all();
        foreach ($clinics as $clinic){
            $step=0;
            for ($i=1;$i<=15;$i++){
                Service::query()->create([
                    'ClinicId'=>$clinic->id,
                    'Name'=>'service '.$i.' for clinic '.$clinic->id,
                    'Description'=>'Description for service '.$i.' for clinic '.$clinic->id,
                    'Step'=>$step+=15
                ]);
            }
        }
    }
}
