<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPaymentTable extends Migration
{
    public function up()
    {
        Schema::create('customer_payment', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('seq_no', 11);
            $table->string('seq_type', 11);
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');

            $table->float('debit');
            $table->float('credit');
            $table->string('notes')->nullable();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_payment');
    }
}