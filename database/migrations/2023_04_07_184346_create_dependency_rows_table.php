<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependencyRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependency_rows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('DependencyId');
            $table->foreign('DependencyId')->references('id')->on('dependencies');
            $table->unsignedBigInteger('RowId');
            $table->foreign('RowId')->references('id')->on('rows');
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
        Schema::dropIfExists('dependency_rows');
    }
}
