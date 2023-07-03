<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('StaticAttributeID')->nullable(true);
            $table->foreign('StaticAttributeID')->references('id')->on('Static_Attributes');
            $table->unsignedBigInteger('DynamicAttributeId')->nullable(true);
            $table->unsignedBigInteger('NewDynamicAttributeId')->nullable(false);
            $table->foreign('DynamicAttributeId')->references('id')->on('Dynamic_Attributes');
            $table->foreign('NewDynamicAttributeId')->references('id')->on('Dynamic_Attributes');
            $table->unsignedBigInteger('OperationId');
            $table->foreign('OperationId')->references('id')->on('operations');
            $table->unsignedBigInteger('ClinicId');
            //name no s
            $table->foreign('ClinicId')->references('id')->on('clinics');
            $table->string('OperationValueString')->nullable(true);
            $table->double('OperationValueDouble')->nullable(true);
            $table->dateTime('OperationValueDateTime')->nullable(true);
            $table->tinyInteger('OperationValueBoolean')->nullable(true);
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
        Schema::dropIfExists('rules');
    }
}
