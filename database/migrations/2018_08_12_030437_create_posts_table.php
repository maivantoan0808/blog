<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('like')->default(0);
            $table->boolean('status')->default(false);
            $table->string('url_img')->nullable();
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
