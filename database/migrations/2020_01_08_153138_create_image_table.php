<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('image')) {
            echo "Table image Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->index();
            $table->string('type', 64);
            $table->unsignedInteger('user_id')->index();
            $table->dateTime('created_at')->useCurrent();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `image` (
        // `id` int unsigned not null auto_increment primary key,
        // `uri` varchar(255) not null,
        // `type` varchar(64) not null,
        // `user_id` int unsigned not null,
        // `created_at` datetime default CURRENT_TIMESTAMP not null
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci',

        // alter table `image` add index `image_uri_index`(`uri`)
        // alter table `image` add index `image_user_id_index`(`user_id`)
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
        Schema::dropIfExists('image');
    }
}
