<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathsTable extends Migration
{
    public function up()
    {
        Schema::create('deaths', function (Blueprint $table) {
            $table->foreignId('action_id')
                ->unique()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('plant_id')
                ->unique()
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('cause_id')
                ->nullable()
                ->constrained('death_causes')
                ->onUpdate('cascade');

            $table->primary('action_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deaths');
    }
}
