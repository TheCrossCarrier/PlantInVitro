<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionTable extends Migration
{
    public function up()
    {
        Schema::create('nutrition', function (Blueprint $table) {
            $table->foreignId('action_id')
                ->unique()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('container_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('nutrient_id')
                ->constrained()
                ->onUpdate('cascade');
            
            $table->primary('action_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nutrition');
    }
}
