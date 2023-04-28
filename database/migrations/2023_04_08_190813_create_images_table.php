<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ClinicId')->nullable(true);
            $table->unsignedBigInteger('DoctorId')->nullable(true);
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->tinyInteger('LocalImage')->nullable(false)->default(0)->comment('0=>no,1=>yes');
            $table->foreign('ClinicId')->references('id')->on('Clinics');
            $table->foreign('DoctorId')->references('id')->on('doctors');
            $table->string('path')->nullable(false);

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
        Schema::dropIfExists('images');
    }
}
