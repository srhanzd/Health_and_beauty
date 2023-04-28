<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Secretaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ClinicId');
            $table->unsignedBigInteger('UserId')->unique();
            $table->tinyInteger('IsDeleted')->default(0)->comment('0=>active,1=>inactive');
            $table->foreign('ClinicId')->references('id')->on('Clinics');
            $table->foreign('UserId')->references('id')->on('Users');
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
        Schema::dropIfExists('Secretaries');
    }
}
