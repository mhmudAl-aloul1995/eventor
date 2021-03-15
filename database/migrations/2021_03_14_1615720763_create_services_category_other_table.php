<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesCategoryOtherTable extends Migration
{
    public function up()
    {
        Schema::create('services_category_other', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('services_category');

            $table->unsignedBigInteger('other_detail_id');
            $table->foreign('other_detail_id')->references('id')->on('other_details');

            $table->string('status', 11)->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services_category_other');
    }
}