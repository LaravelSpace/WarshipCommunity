<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('articles')) {
            echo "Table articles Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('articles', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('title', 64)->index(); // 标题
            $table->string('body', 64); // 内容
            $table->unsignedInteger('user_id')->index(); // DB:users->id
            $table->unsignedTinyInteger('examine')->default(0);
            // DB:articles->examine(审核状态):0=未触发,1=待审核,2=通过,3=拒绝
            $table->boolean('blacklist')->default(false); // 黑名单
            $table->dateTime('deleted_at')->nullable(); // 软删除的时间
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `articles` (
        // `id` int unsigned not null auto_increment primary key,
        // `title` varchar(64) not null,
        // `body` varchar(64) not null,
        // `user_id` int unsigned not null,
        // `examine` tinyint unsigned not null default '0',
        // `blacklist` tinyint(1) not null default '0',
        // `deleted_at` datetime null,
        // `created_at` datetime not null default CURRENT_TIMESTAMP,
        // `updated_at` datetime null ON UPDATE CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `articles` add index `articles_title_index`(`title`)
        // alter table `articles` add index `articles_user_id_index`(`user_id`)
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
        Schema::dropIfExists('articles');
    }
}
