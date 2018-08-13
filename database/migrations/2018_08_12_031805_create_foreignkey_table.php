<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignkeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('topic_id')->references('id')->on('topics')
                  ->onDelete('cascade');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                  ->onDelete('cascade');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                  ->onDelete('cascade');
        });
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('cascade');
        });
        Schema::table('comment_likes', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_key');
    }
}
