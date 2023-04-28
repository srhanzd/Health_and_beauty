<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Dynamic_Attribute_Values', function (Blueprint $table) {
            $table->id();
            $table->text('ValueString')->nullable(true);
            $table->double('ValueDouble')->nullable(true);
            $table->dateTime('ValueDateTime')->nullable(true);
            $table->tinyInteger('ValueBoolean')->nullable(true);
            $table->unsignedBigInteger('DynamicAttributeId');
            $table->foreign('DynamicAttributeId')->references('id')->on('Dynamic_Attributes');
            $table->tinyInteger('Disable')->default(0);
            $table->unsignedBigInteger('ClinicId');
            $table->foreign('ClinicId')->references('id')->on('Clinics');
            $table->unsignedBigInteger('PatientId');
            $table->foreign('PatientId')->references('id')->on('Patients');
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
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
        Schema::dropIfExists('Dynamic_Attribute_Values');
    }
}
