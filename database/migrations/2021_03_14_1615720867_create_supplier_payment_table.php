<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierPaymentTable extends Migration
{
    public function up()
    {
        Schema::create('supplier_payment', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('seq_no', 11);
            $table->string('seq_type', 11);

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

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
        Schema::dropIfExists('supplier_payment');
    }
}