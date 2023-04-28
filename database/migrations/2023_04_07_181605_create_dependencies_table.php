<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('DynamicAttributeId');
            $table->foreign('DynamicAttributeId')->references('id')->on('Dynamic_Attributes');
            $table->unsignedBigInteger('OperationId');
            $table->foreign('OperationId')->references('id')->on('operations');
            $table->text('ValueString')->nullable(true);
            $table->double('ValueDouble')->nullable(true);
            $table->dateTime('ValueDateTime')->nullable(true);
            $table->tinyInteger('ValueBoolean')->nullable(true);
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
        Schema::dropIfExists('dependencies');
    }
}
