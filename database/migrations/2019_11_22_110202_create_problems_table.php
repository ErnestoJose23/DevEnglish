<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->unsigned()->nullable();
            $table->string('title');
            $table->text('content');
            $table->boolean('active');
            $table->integer('topic_id')->unsigned()->nullable();
            $table->string('token');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('topic_id')
            ->references('id')
            ->on('topics');

            $table->foreign('type')
            ->references('id')
            ->on('problem_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
}
