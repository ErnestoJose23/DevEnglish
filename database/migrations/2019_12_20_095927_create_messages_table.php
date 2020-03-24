<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content')->nullable();
            $table->integer('chat_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->tinyInteger('is_read');
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('chat_id')
                ->references('id')
                ->on('chats')
                ->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('messages');
    }
}
