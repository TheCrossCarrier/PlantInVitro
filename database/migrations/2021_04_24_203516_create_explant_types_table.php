<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplantTypesTable extends Migration
{
    public function up()
    {
        Schema::create('explant_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('explant_types');
    }
}
