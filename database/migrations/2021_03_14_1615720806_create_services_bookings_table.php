<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('services_bookings', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('services_id');
            $table->foreign('services_id')->references('id')->on('services');

            $table->string('booking_type', 11);
            $table->string('id_ref', 11)->default(1);
            $table->string('from_date', 50);
            $table->string('to_date', 50);
            $table->text('description')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services_booking');
    }
}