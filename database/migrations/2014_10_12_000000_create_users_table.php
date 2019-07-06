<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            return; // 如果表已存在
        }
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 32);
            $table->string('email', 64)->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 32)->default('');
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password', 64);
            $table->string('avatar',128);
            $table->string('api_token', 64);
            $table->rememberToken();
            $table->timestamps();
            $table->unique('name');
            $table->index('email');
            $table->index('phone');
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
