<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLanguages extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('file');
            $table->string('icon')->nullable();
            $table->string('status', 11);
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('language');
    }
}