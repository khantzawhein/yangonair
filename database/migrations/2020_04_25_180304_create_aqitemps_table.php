<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAqitempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aqitemps', function (Blueprint $table) {
            $table->id();
            $table->integer('sensor0')->nullable();
            $table->integer('sensor1')->nullable();
            $table->integer('sensor2')->nullable();
            $table->integer('sensor3')->nullable();
            $table->integer('sensor4')->nullable();
            $table->integer('sensor5')->nullable();
            $table->integer('sensor6')->nullable();
            $table->integer('sensor7')->nullable();
            $table->integer('sensor8')->nullable();
            $table->integer('sensor9')->nullable();
            $table->integer('sensor10')->nullable();
            $table->integer('overall');
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
        Schema::dropIfExists('aqitemps');
    }
}
