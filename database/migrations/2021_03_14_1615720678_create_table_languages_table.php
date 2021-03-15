<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('table_languages', function (Blueprint $table) {

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