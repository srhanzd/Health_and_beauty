<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Static_Attributes', function (Blueprint $table) {
            $table->id();
            $table->text('Key')->nullable(false);
            $table->text('Label')->nullable(false);
            $table->unsignedBigInteger('ClinicId');
            $table->foreign('ClinicId')->references('id')->on('Clinics');
            $table->text('Description')->nullable(true);
            $table->tinyInteger('Required')->default(0);
            $table->tinyInteger('Enable')->default(1);
            $table->unsignedBigInteger('DataTypeId');
            $table->foreign('DataTypeId')->references('id')->on('Data_Types');
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
        Schema::dropIfExists('Static_Attributes');
    }
}
