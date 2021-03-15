<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTypesTable extends Migration
{
    public function up()
    {
        Schema::create('event_types', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('status', 11);
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->string('type_description')->nullable();
            $table->string('parent', 11)->default(0);
            $table->string('sort', 11)->default(0);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_types');
    }
}