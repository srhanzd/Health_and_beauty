<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MedicalInfoId')->nullable(false);
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->foreign('MedicalInfoId')->references('id')->on('Medical_Informations');
            $table->string('Type')->nullable(false);
            $table->text('AllergicTo')->nullable(false);
            $table->text('Description')->nullable(false);
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
        Schema::dropIfExists('allergies');
    }
}
