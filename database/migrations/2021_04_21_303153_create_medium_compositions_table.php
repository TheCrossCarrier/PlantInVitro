<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumCompositionsTable extends Migration
{
    public function up()
    {
        Schema::create('medium_compositions', function (Blueprint $table) {
            $table->foreignId('medium_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('component_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->float('concentration')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();

            $table->primary(['medium_id', 'component_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('medium_compositions');
    }
}
