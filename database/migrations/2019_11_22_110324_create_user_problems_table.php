<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_problems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('problem_id')->unsigned();
            $table->integer('right');
            $table->integer('wrong');
            $table->float('grade');
            $table->integer('topic_id')->unsigned();
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->foreign('problem_id')
            ->references('id')
            ->on('problems');

            $table->foreign('topic_id')
            ->references('id')
            ->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_problems');
    }
}
