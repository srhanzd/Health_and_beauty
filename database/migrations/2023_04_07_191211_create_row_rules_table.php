<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('row_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('RowId');
            $table->foreign('RowId')->references('id')->on('rows');
            $table->unsignedBigInteger('RuleId');
            $table->foreign('RuleId')->references('id')->on('rules');
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
        Schema::dropIfExists('row_rules');
    }
}
