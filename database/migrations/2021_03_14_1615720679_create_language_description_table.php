<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguageDescriptionTable extends Migration
{
    public function up()
    {
        Schema::create('language_description', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('table_language_id');
          //  $table->foreign('table_language_id')->references('id')->on('table_languages');

            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');

            $table->string('id_ref')->nullable();
            $table->string('remarks')->nullable();
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('language_description');
    }
}