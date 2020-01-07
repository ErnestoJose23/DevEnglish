<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('term');
            $table->string('afi')->nullable();
            $table->longText('definition');
            $table->integer('topic_id')->unsigned()->nullable();
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
        Schema::dropIfExists('terms');
    }
}
