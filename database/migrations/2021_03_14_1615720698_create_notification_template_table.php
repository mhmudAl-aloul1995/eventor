<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTemplateTable extends Migration
{
    public function up()
    {
        Schema::create('notification_template', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subject');
            $table->text('mail_content');
            $table->text('message_content')->nullable();
            $table->string('image')->nullable();
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_template');
    }
}