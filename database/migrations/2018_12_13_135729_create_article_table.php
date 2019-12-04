<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('APP_ENV') !== 'local') {
            echo "Not In Local Environment! \n";
            return;
        }
        if (Schema::hasTable('article')) {
            echo "Table article Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('article', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('title', 64)->index();
            $table->string('body', 64);
            $table->unsignedInteger('user_id')->index();
            $table->unsignedTinyInteger('examine')->default(0);
            $table->boolean('blacklist')->default(false);
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
            echo "Not In Local Environment! \n";
            return;
        }
        Schema::dropIfExists('article');
    }
}
