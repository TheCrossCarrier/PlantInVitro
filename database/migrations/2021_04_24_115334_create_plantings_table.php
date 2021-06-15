<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantings', function (Blueprint $table) {
            $table->foreignId('action_id')
                ->unique()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('plant_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('container_id')
                ->constrained()
                ->onUpdate('cascade');

            $table->primary('action_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantings');
    }
}
