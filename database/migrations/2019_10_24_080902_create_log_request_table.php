<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('log_request')) {
            echo "Table log_request Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('log_request', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('ip',64);
            $table->string('url',64);
            $table->string('request',64);
            $table->string('response',64)->nullable();
            $table->timestamps();
            $table->index('url');
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `log_request` (
        // `id` int unsigned not null auto_increment primary key,
        // `ip` varchar(64) not null,
        // `url` varchar(64) not null,
        // `request` varchar(64) not null,
        // `response` varchar(64) not null,
        // `created_at` timestamp default CURRENT_TIMESTAMP null,
        // `updated_at` timestamp null ON UPDATE CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `log_request` add index `log_request_url_index`(`url`)
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
        Schema::dropIfExists('log_request');
    }
}
