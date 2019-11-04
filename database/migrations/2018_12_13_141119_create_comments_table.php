<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('comments')) {
            echo "Table comments Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('comments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('body', 64); // 内容
            $table->unsignedInteger('user_id')->index(); // table:users->id
            $table->unsignedInteger('article_id')->index(); // table:articles->id
            $table->unsignedTinyInteger('examine')->default(0);
            // DB:comments->examine(审核状态):0=未触发,1=待审核,2=通过,3=拒绝
            $table->boolean('blacklist')->default(false); // 黑名单
            $table->dateTime('deleted_at')->nullable(); // 软删除的时间
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `comments` (
        // `id` int unsigned not null auto_increment primary key,
        // `body` varchar(64) not null,
        // `user_id` int unsigned not null,
        // `article_id` int unsigned not null,
        // `examine` tinyint unsigned not null default '0',
        // `blacklist` tinyint(1) not null default '0',
        // `deleted_at` datetime null,
        // `created_at` datetime not null default CURRENT_TIMESTAMP,
        // `updated_at` datetime null ON UPDATE CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `comments` add index `comments_user_id_index`(`user_id`)
        // alter table `comments` add index `comments_article_id_index`(`article_id`)
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
        Schema::dropIfExists('comments');
    }
}
