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
        if (!env('APP_DEBUG')) {
            echo "Not In Test Environment! \n";
            return;
        }
        if (Schema::hasTable('users')) {
            echo "Table users Is Already Exist! \n";
            return; // 如果表已存在
        }
        Schema::create('users', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 32); // 昵称
            $table->string('email', 64)->default(''); // 邮箱地址
            $table->timestamp('email_verified_at')->nullable(); // 邮箱地址验证时间
            $table->string('phone', 32)->default(''); // 手机号码
            $table->timestamp('phone_verified_at')->nullable(); // 手机号码验证时间
            $table->string('password', 64); // 密码 hash 处理
            $table->string('avatar', 128); // 头像图片地址
            $table->string('api_token', 64); // Api token
            $table->rememberToken();
            $table->timestamps();
            $table->unique('name'); // 唯一索引
            $table->index('email'); // 普通索引
            $table->index('phone'); // 普通索引
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
