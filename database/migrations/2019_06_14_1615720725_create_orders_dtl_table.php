<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersDtlTable extends Migration
{
    public function up()
    {
        Schema::create('orders_dtl', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->unsignedBigInteger('service_id');
           // $table->foreign('service_id')->references('id')->on('services');

            $table->string('invoice_date', 50);
            $table->string('from_date', 50);
            $table->string('to_date', 50);
            $table->string('price', 11);
            $table->string('is_vat', 11)->default(0);
            $table->string('vat_price', 11);
            $table->string('discount', 11)->default(0);
            $table->string('net_price', 11);
            $table->string('service_status', 50);
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('orders_dtl');
    }
}