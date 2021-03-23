<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLanguageTables extends Migration
{
    public function up()
    {
        Schema::create('language_tables', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('table_description');
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();


        });
    }

    public function down()
    {
        Schema::dropIfExists('table_language');
    }
}