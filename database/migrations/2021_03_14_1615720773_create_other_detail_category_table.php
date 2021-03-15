<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDetailCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('other_detail_category', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('other_detail_id');
            $table->foreign('other_detail_id')->references('id')->on('other_details');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('services_category');

            $table->string('status', 11)->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('other_detail_category');
    }
}