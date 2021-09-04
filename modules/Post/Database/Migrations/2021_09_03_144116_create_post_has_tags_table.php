<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostHasTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_has_tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->unsigned()->references('id')->on('posts')->onDelete('cascade');
            $table->bigInteger('tag_id')->unsigned()->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('post_has_tags');
    }
}
