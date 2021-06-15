<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSterilizationModesTable extends Migration
{
    public function up()
    {
        Schema::create('sterilization_modes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('temperature')->nullable();
            $table->float('pressure')->nullable();
            $table->time('duration')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sterilization_modes');
    }
}
