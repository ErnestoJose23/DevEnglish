<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('topic_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('descp')->nullable();
            $table->string('url')->nullable();
            $table->integer('type')->unsigned()->nullable();
            $table->boolean('active');
            $table->string('token');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('topic_id')
                    ->references('id')
                    ->on('topics')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
