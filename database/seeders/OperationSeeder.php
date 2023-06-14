<?php

namespace Database\Seeders;

use App\Models\Operation;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operation::create([
            'Name' => '>',
        ]);

        Operation::create([
            'Name' => '<',
        ]);

        Operation::create([
            'Name' => '<=',
        ]);

        Operation::create([
            'Name' => '>=',
        ]);

        Operation::create([
            'Name' => '=',
        ]);

        Operation::create([
            'Name' => '!=',
        ]);
    }

}
