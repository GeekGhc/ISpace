<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_series_id')->unsigned();
            $table->integer('series_index')->default(0);
            $table->string('title');
            $table->string('intro');
            $table->string('poster');
            $table->integer('comment_count')->default(0);
            $table->string('url');
            $table->foreign('video_series_id')
                  ->references('id')
                  ->on('video_series')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
