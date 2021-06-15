<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')
                ->constrained('container_types')
                ->onUpdate('cascade');
            $table->foreignId('medium_id')
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
        Schema::dropIfExists('containers');
    }
}
