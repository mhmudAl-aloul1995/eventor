<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressTable extends Migration
{
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('address_type');
            $table->string('soc_name');
            $table->string('street');
            $table->string('city');
            $table->string('zipcode');
            $table->string('lat', 50)->nullable();
            $table->string('lang', 50)->nullable();
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_address');
    }
}