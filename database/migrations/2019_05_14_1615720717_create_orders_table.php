<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('order_no', 50);
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');

            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons');

            $table->string('address_id', 11)->nullable();
            $table->string('payment', 11);
            $table->string('date', 50)->nullable();
            $table->string('time', 50)->nullable();
            $table->string('coupon_price', 11)->default(0);
            $table->string('discount', 11)->default(0);
            $table->string('order_status', 50);
            $table->string('payment_status', 11);
            $table->string('payment_type', 50);
            $table->string('payment_token', 50)->nullable();
            $table->string('order_otp', 11)->nullable();
            $table->string('reject_by')->nullable();
            $table->string('review_status', 11)->default(0);
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}