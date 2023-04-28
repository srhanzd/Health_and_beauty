<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->text('Data');
            $table->unsignedBigInteger('FromUserId')->nullable(true);
            $table->unsignedBigInteger('ToUserId');
            $table->integer('IsDeleted')->default(0)->comment("0=>Active, 1=>Deleted");
            $table->timestamps();
            $table->foreign('FromUserId')->references('id')->on('users');
            $table->foreign('ToUserId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
