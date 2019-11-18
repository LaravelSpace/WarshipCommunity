<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user')) {
            echo "Table user Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('user', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 32)->unique(); // 昵称
            $table->string('email', 32)->unique(); // 邮箱地址
            $table->dateTime('email_verified_at')->nullable(); // 邮箱地址验证时间
            $table->string('phone', 32)->unique(); // 手机号码
            $table->dateTime('phone_verified_at')->nullable(); // 手机号码验证时间
            $table->string('password', 64); // 密码，默认使用框架的 Hash::make() 处理
            $table->string('avatar', 128); // 头像图片 uri
            $table->string('api_token', 64); // 用于授权
            $table->string('remember_token', 64); // 用于记住我
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `user` (
        // `id` int unsigned not null auto_increment primary key,
        // `name` varchar(16) not null,
        // `email` varchar(64) not null,
        // `email_verified_at` datetime null,
        // `phone` varchar(16) not null,
        // `phone_verified_at` datetime null,
        // `password` varchar(64) not null,
        // `avatar` varchar(128) not null,
        // `api_token` varchar(64) not null,
        // `remember_token` varchar(64) null,
        // `created_at` datetime not null default CURRENT_TIMESTAMP,
        // `updated_at` datetime null ON UPDATE CURRENT_TIMESTAMP
        // ) AUTO_INCREMENT=1000 default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `user` add unique `user_name_unique`(`name`)
        // alter table `user` add unique `user_email_unique`(`email`)
        // alter table `user` add unique `user_phone_unique`(`phone`)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!env('APP_DEBUG')) {
            echo "Not In Test Environment! \n";
            return;
        }
        Schema::dropIfExists('user');
    }
}
