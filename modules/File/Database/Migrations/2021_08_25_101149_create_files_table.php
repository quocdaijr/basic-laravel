<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('description')->nullable();
            $table->tinyInteger('status');
            $table->string('raw_path');
            $table->string('path');
            $table->string('url')->nullable();
            $table->string('where', '30');
            $table->string('type');
            $table->string('mine_type');
            $table->string('size')->nullable();
            $table->string('mtime')->nullable();
            $table->text('options')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
