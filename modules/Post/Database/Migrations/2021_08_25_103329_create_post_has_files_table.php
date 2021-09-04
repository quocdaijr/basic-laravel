<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostHasFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_has_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->unsigned()->references('id')->on('posts')->onDelete('cascade');
            $table->bigInteger('file_id')->unsigned()->references('id')->on('files')->onDelete('cascade');
            $table->tinyInteger('type');

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
        Schema::dropIfExists('post_has_files');
    }
}
