<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleVaccinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_vaccination', function (Blueprint $table) {
            $table->foreignId('people_id')->constrained()->onDelete('cascade');
            $table->foreignId('vaccination_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->primary(['people_id', 'vaccination_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people_vaccination');
    }
}
