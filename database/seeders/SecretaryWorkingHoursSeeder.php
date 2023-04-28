<?php

namespace Database\Seeders;

use App\Models\DoctorWorkingHour;
use App\Models\SecretaryWorkingHour;
use App\Models\WorkingDay;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SecretaryWorkingHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $working_days=WorkingDay::query()->where('off','=',0)->get();
        for ($i = 4; $i <= 6; $i++) {
            foreach ($working_days as $day) {
                if ($day->id == 1) {
                    SecretaryWorkingHour::query()->create([
                        'SecretaryId' => $i,
                        'WorkingDaysId' => $day->id,
                        'From' => Carbon::createFromTime(10, 0, 0)->format('H:i'),
                        'to' => Carbon::createFromTime(15, 0, 0)->format('H:i'),
                        'off' => 1
                    ]);
                } else {
                    SecretaryWorkingHour::query()->create([
                        'SecretaryId' => $i,
                        'WorkingDaysId' => $day->id,
                        'From' => Carbon::createFromTime(10, 0, 0)->format('H:i'),
                        'to' => Carbon::createFromTime(15, 0, 0)->format('H:i'),

                    ]);
                }
            }
        }
    }
}
