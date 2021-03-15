<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code');
            $table->string('type', 50);
            $table->string('discount', 11);
            $table->string('max_use', 11);
            $table->string('start_date', 50);
            $table->string('end_date', 50);
            $table->string('use_count', 11);
            $table->string('status', 11);
            $table->float('total_apply')->nullable();
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('coupon');
    }
}