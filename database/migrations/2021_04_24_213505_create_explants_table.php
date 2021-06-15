<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExplantsTable extends Migration
{
    public function up()
    {
        Schema::create('explants', function (Blueprint $table) {
            $table->foreignId('action_id')
                ->constrained('plantings', 'action_id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('explant_type_id')
                ->constrained()
                ->onUpdate('cascade');

            $table->primary(['action_id', 'explant_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('explants');
    }
}
