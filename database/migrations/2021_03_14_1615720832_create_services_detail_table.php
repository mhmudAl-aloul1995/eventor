<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesDetailTable extends Migration
{
    public function up()
    {
        Schema::create('services_detail', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');

            $table->unsignedBigInteger('other_detail_id');
            $table->foreign('other_detail_id')->references('id')->on('other_details');

            $table->text('description')->nullable();
            $table->string('status', 11)->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services_detail');
    }
}