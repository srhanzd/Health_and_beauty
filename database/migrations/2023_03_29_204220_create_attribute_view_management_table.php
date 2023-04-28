<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeViewManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ///the name in database should have s
        Schema::create('Attributes_View_Management', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('Enable')->default(1);
            $table->unsignedBigInteger('ClinicId');
            $table->foreign('ClinicId')->references('id')->on('clinics');
            $table->unsignedBigInteger('StaticAttributeId')->nullable(true);
            $table->foreign('StaticAttributeId')->references('id')->on('Static_Attributes');
            $table->unsignedBigInteger('DynamicAttributeId')->nullable(true);
            $table->foreign('DynamicAttributeId')->references('id')->on('Dynamic_Attributes');
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
        Schema::dropIfExists('Attribute_View_Management');
    }
}
