<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')
                ->constrained('action_types')
                ->onUpdate('restrict');
            $table->dateTime('date')->nullable();
            $table->string('comment')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
