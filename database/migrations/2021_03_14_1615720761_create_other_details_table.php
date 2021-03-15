<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('other_details', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->text('other_description')->nullable();
            $table->unsignedBigInteger('order_status_id');
            $table->foreign('order_status_id')->references('id')->on('order_status');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('other_detail');
    }
}