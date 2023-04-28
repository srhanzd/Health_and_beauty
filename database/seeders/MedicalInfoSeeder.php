<?php

namespace Database\Seeders;

use App\Models\Allergy;
use App\Models\Immunization;
use App\Models\MedicalInformation;
use App\Models\Medicine;
use App\Models\Surgery;
use Illuminate\Database\Seeder;

class MedicalInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $medical_info= MedicalInformation::query()->create([
           'PatientId'=> 7,
           'Height'=> 177,
           'BGroup'=> 'A+',
           'Pulse'=> '60',
           'Weight'=> 75,
           'BPressure'=> '12/9',
           'Respiration' => '20',
           'Diet'=> 'Noun',
       ]);
       Medicine::query()->create([
           'MedicalInfoId'=>$medical_info->id,
           'Name'=>'Ibuprofen',
           'Description'=>'Ibuprofen Description'
       ]);
       Surgery::query()->create([
           'MedicalInfoId'=>$medical_info->id,
           'Name'=>'HandSurgery',
           'Description'=>'HandSurgery Description',
           'Date'=>now()
       ]);
       Immunization::query()->create([
           'MedicalInfoId'=>$medical_info->id,
           'Name'=>'DTaP',
           'Description'=>'DTaP Description',
           'Date'=>now()
       ]);
       Allergy::query()->create([
           'MedicalInfoId'=>$medical_info->id,
           'Type'=>'food allergy',
           'AllergicTo'=>'peanuts',
           'Description'=>'peanuts allergy Description',
       ]);

    }
}
