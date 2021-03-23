<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusTable extends Migration
{
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('status_name');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('order_status');
    }
}