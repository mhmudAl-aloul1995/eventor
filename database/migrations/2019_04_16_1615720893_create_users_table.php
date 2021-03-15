<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('email', 191)->nullable();
            $table->string('phone_code', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('location')->nullable();

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->text('address')->nullable();
            $table->string('address_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->string('image')->default('user.png');
            $table->string('remember_token', 100)->nullable();
            $table->string('terms_condations', 11)->default(0);
            $table->string('verify', 11)->default(0);
            $table->string('status', 11)->default(0);
            $table->string('lat', 50)->nullable();
            $table->string('long', 50)->nullable();
            $table->string('enable_notification', 11)->default(0);
            $table->string('enable_location', 11)->default(0);
            $table->timestamp('last_login')->nullable();
            $table->string('ip_number')->nullable();
            $table->string('gender', 4)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->datetime('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}