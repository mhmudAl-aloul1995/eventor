<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('priority', 11)->default(0);
            $table->float('price');
            $table->boolean('is_vat', 11)->default(1);
            $table->string('vat_no');

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->string('Infants_from', 11)->default(0);
            $table->string('Infants_to', 11)->default(0);
            $table->string('children_from', 11)->default(0);
            $table->string('children_to', 11)->default(0);
            $table->string('Adults_from', 11)->default(0);
            $table->string('Adults_to', 11)->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}