<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PrescriptionId')->nullable(true);
            $table->unsignedBigInteger('MedicalInfoId')->nullable(false);
            $table->foreign('MedicalInfoId')->references('id')->on('Medical_Informations');
            $table->string('Name');
            $table->text('Description');
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->foreign('PrescriptionId')->references('id')->on('Prescriptions');
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
        Schema::dropIfExists('Medicines');
    }
}
