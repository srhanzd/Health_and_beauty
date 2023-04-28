<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserId')->unique();
            $table->unsignedBigInteger('ClinicId');
//            $table->string('Title');
//            $table->string('Fees');
            $table->string('Degree');
            $table->text('AboutMe');
            $table->string('Specialization');
           // $table->integer('slot_time')->nullable();
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->tinyInteger('IsHeadOfClinic')->default(0)->comment('0=>no,1=>yes');
            $table->foreign('UserId')->references('id')->on('Users');
            $table->foreign('ClinicId')->references('id')->on('Clinics');
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
        Schema::dropIfExists('Doctors');
    }
}
