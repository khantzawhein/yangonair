<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw', function (Blueprint $table) {
            $table->id();
            $table->decimal('sensor0');
            $table->decimal('sensor1');
            $table->decimal('sensor2');
            $table->decimal('sensor3');
            $table->decimal('sensor4');
            $table->decimal('sensor5');
            $table->decimal('sensor6');
            $table->decimal('sensor7');
            $table->decimal('sensor8');
            $table->decimal('sensor9');
            $table->decimal('sensor10');
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
        Schema::dropIfExists('raw');
    }
}
