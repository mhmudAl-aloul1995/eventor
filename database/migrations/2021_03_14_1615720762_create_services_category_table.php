<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('services_category', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('image')->nullable();
            $table->string('status', 11);
            $table->string('category_description')->nullable();
            $table->string('parent', 11)->default(0);
            $table->string('sort', 11)->default(0);
            $table->string('determine_invitees', 11)->default(0);
            $table->boolean('is_base', 1)->default(0);
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('services_category');
    }
}