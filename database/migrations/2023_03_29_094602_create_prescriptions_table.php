<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('AppointmentId');
            $table->string('Symptoms');
            $table->string('Diagnosis');
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->foreign('AppointmentId')->references('id')->on('Appointments');
            $table->unsignedBigInteger('MedicalInfoId')->nullable(false);
            $table->foreign('MedicalInfoId')->references('id')->on('Medical_Informations');
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
        Schema::dropIfExists('Prescriptions');
    }
}
