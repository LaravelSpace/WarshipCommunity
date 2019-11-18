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
            $table->string('ip', 32);
            $table->string('client', 32);
            $table->unsignedInteger('client_id');
            $table->string('uri', 64)->index();
            $table->string('request', 64);
            $table->string('response', 64)->default('');
            $table->unsignedInteger('consumption')->default(0);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->index(['client', 'client_id', 'uri']);
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `log_request` (
        // `id` int unsigned not null auto_increment primary key,
        // `ip` varchar(32) not null,
        // `client` varchar(32) not null
        // `client_id` int unsigned not null,
        // `uri` varchar(64) not null,
        // `request` varchar(64) not null,
        // `response` varchar(64) not null default '',
        // `consumption` int unsigned not null default 0,
        // `created_at` datetime not null default CURRENT_TIMESTAMP,
        // `updated_at` datetime null ON UPDATE CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `log_request` add index `log_request_uri_index`(`uri`)
        // alter table `log_request` add index `log_request_client_client_id_uri_index`(`client`, `client_id`, `uri`)
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
