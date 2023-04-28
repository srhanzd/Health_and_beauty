<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Medical_Informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PatientId');
            $table->string('Height');
            $table->string('BGroup');
            $table->string('Pulse');
          //  $table->string('Allergy')->nullable(true);
            $table->string('Weight');
            $table->string('BPressure');
            $table->string('Respiration');
            $table->string('Diet');
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->foreign('PatientId')->references('id')->on('Users');
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
        Schema::dropIfExists('Medical_Informations');
    }
}
