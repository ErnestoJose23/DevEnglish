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
            $table->integer('problem_type_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('content');
            $table->boolean('isActive');
            $table->integer('topic_id')->unsigned()->nullable();
            $table->integer('display')->nullable();
            $table->string('token');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('topic_id')
            ->references('id')
            ->on('topics');

            $table->foreign('problem_type_id')
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
