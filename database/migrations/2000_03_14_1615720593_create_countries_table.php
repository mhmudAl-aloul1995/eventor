<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('code', 3);
            $table->string('name', 52);
            $table->enum('continent', ['Asia', 'Europe', 'North America', 'Africa', 'Oceania', 'Antarctica', 'South America'])->nullable();
            $table->string('government_form', 45)->nullable();
            $table->string('head_of_state', 60)->nullable();
            $table->string('code2', 2)->nullable();
            $table->string('status', 11)->default(1);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}