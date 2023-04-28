<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Dynamic_Attributes', function (Blueprint $table) {
            $table->id();
            $table->text('Key')->nullable(false);
            $table->unsignedBigInteger('DataTypeId');
            $table->foreign('DataTypeId')->references('id')->on('Data_Types');
//            $table->integer('DataTypeId')->nullable(false);
            $table->text('Description')->nullable(true);
            $table->unsignedBigInteger('ClinicId');
            $table->foreign('ClinicId')->references('id')->on('Clinics');
            $table->tinyInteger('Required')->default(0);
            $table->tinyInteger('Disable')->default(0);
            $table->text('DefaultValue')->nullable(true);
            $table->tinyInteger('IsHealthStandard')->default(0)->comment('0=>no,1=>yes');
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
        Schema::dropIfExists('Dynamic_Attributes');
    }
}
