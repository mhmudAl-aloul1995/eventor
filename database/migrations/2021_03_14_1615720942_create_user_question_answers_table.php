<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestionAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('user_question_answers', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions');


            $table->string('user_answer');
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_question_answers');
    }
}