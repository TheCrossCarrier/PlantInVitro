<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutrientsTable extends Migration
{
    public function up()
    {
        Schema::create('nutrients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('concentration')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nutrients');
    }
}
