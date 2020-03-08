<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('discussion')) {
            echo 'Table discussion Is Already Exist!' . PHP_EOL;
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('discussion', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('body', 64);
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('comment_id')->index();
            $table->unsignedTinyInteger('examine')->default(0);
            $table->boolean('blacklist')->default(false);
            $table->unsignedInteger('star_num')->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
        // \Log::debug(\DB::getQueryLog());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (env('APP_ENV') !== 'local') {
            echo 'Not In Local Environment!' . PHP_EOL;
            return;
        }
        Schema::dropIfExists('discussion');
    }
}
