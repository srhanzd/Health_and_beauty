<?php

namespace Database\Seeders;

use App\Models\DataType;
use Illuminate\Database\Seeder;

class DataTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataType::create([
            'Name' => 'Date',
        ]);

        DataType::create([
            'Name' => 'Number',
        ]);

        DataType::create([
            'Name' => 'Boolean',
        ]);

        DataType::create([
            'Name' => 'Text',
        ]);
    }


}
