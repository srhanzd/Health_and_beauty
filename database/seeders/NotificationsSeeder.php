<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Notification::query()->create([
           'Title'=>'test Title',
           'Data'=>'test Data',
           'ToUserId'=>7
       ]);
    }
}
