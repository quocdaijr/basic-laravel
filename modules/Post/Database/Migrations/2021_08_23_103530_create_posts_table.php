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
            $table->unsignedBigInteger('id');
            $table->string('name');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('slug')->unique();
            $table->longText('content');
            $table->tinyInteger('status');
            $table->string('author')->nullable();
            $table->string('location')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->timestamp('published_at');
            $table->timestamp('published_at');
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
