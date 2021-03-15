<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('location')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('description')->nullable();
            $table->string('logo', 50);
            $table->string('favicon', 50);
            $table->float('balance')->default(0);

            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}