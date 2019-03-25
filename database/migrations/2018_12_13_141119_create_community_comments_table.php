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
        if (Schema::hasTable('community_comments')) {
            // 如果表已存在
            return;
        }
        Schema::create('community_comments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->text('main_body');
            $table->integer('user_id');
            $table->integer('article_id');
            $table->boolean('blacklist')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('community_comments');
    }
}
