<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->constrained('plants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('child_id')
                ->constrained('plants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->timestamps();

            $table->primary(['parent_id', 'child_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('relations');
    }
}
