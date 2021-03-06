<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->date('birthday');
            $table->string('gender');
            $table->string('sv_number')->unique();
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telephone_number');
            $table->boolean('isRegistred')->default(false);
            $table->boolean('isVaccinated')->default(false);
            $table->boolean('isAdmin')->default(false);

            $table->foreignId('vaccination_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
