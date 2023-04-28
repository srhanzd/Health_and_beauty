<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::query()->create([
            'LocalImage'=>1,
            'path'=>'storage/app/public/s.PNG'
        ]);
        Image::query()->create([
            'ClinicId'=>1,
            'path'=>'storage/app/public/c.PNG'
        ]);
        Image::query()->create([
            'DoctorId'=>1,
            'path'=>'storage/app/public/d.PNG'
        ]);
    }
}
