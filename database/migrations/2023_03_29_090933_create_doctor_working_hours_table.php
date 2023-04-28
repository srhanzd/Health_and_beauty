<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Doctor_Working_Hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('DoctorId');
            $table->unsignedBigInteger('WorkingDaysId');
            $table->time('From');
            $table->time('To');
//            $table->unsignedInteger('Step')->default(60);
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->foreign('DoctorId')->references('id')->on('Users');
            $table->foreign('WorkingDaysId')->references('id')->on('Working_Days');
            $table->boolean('Off')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Doctor_Working_Hours');
    }
}
