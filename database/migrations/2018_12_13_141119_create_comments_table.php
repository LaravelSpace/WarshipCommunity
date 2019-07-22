<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('comments')) {
            return;
        }
        Schema::create('comments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->text('main_body'); // 内容
            $table->unsignedInteger('user_id'); // table:users->id
            $table->unsignedInteger('article_id'); // table:articles->id
            $table->unsignedTinyInteger('examine')->default(0); // 审核状态:0=未触发,1=待审核,2=通过,3=拒绝
            $table->boolean('blacklist')->default(false); // 黑名单
            $table->softDeletes(); // 软删除
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
        Schema::dropIfExists('comments');
    }
}
