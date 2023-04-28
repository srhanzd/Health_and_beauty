<?php

namespace Database\Seeders;

use App\Models\WorkingDay;
use Illuminate\Database\Seeder;

class WorkingDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = config('appointment.days');
        foreach ($days as $day) {
            if ($day == 'Friday') {
                WorkingDay::query()->updateOrCreate(
                    [
                        'day' => $day,
                        'off' => true

                    ]
                );
            }
            else{
                WorkingDay::query()->updateOrCreate(
                    [
                        'day' => $day,
                        'off' => false

                    ]
                );
            }
        }
    }
}
