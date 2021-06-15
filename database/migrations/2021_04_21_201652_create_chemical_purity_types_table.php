<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChemicalPurityTypesTable extends Migration
{
    public function up()
    {
        Schema::create('chemical_purity_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chemical_purity_types');
    }
}
