<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PatientId');
            $table->unsignedBigInteger('DoctorId');
            $table->unsignedBigInteger('ServiceId');
            $table->date('Date');
            $table->time('Time');
            $table->string('Status')->default(0)->comment('0=>pending,1=>complete,2=>cancel');
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->tinyInteger('Notified')->default(0)->comment('0=>no,1=>yes');
            $table->foreign('PatientId')->references('id')->on('Patients');
            $table->foreign('DoctorId')->references('id')->on('Doctors');
            $table->foreign('ServiceId')->references('id')->on('Services');
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
        Schema::dropIfExists('Appointments');
    }
}
