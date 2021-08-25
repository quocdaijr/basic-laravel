<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->tinyInteger('status');
            $table->string('two_factor_secret')->nullable();
            $table->string('two_factor_recovery_codes')->nullable();
            $table->rememberToken();
            $table->string('profile_full_name')->nullable();
            $table->string('profile_gender')->nullable();
            $table->string('profile_birthday')->nullable();
            $table->string('profile_address')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamp('latest_login')->nullable();
            $table->timestamps();

            $table->index('username');
            $table->index('password');
            $table->index('status');
            $table->index('two_factor_secret');
            $table->index('latest_login');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
