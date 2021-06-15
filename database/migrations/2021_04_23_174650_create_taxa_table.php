<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxaTable extends Migration
{
    public function up()
    {
        Schema::create('taxa', function (Blueprint $table) {
            $table->id();
            $table->string('subspecies')->nullable();
            $table->string('species')->nullable();
            $table->string('genus')->nullable();
            $table->string('family')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('taxa');
    }
}
