<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('chemical_name');
            $table->foreignId('type_id')
                ->constrained('component_types')
                ->onUpdate('cascade');
            $table->string('formula')->nullable();
            $table->foreignId('chemical_purity_type_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('components');
    }
}
