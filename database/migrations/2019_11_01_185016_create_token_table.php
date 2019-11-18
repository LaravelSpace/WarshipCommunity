<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('token')) {
            echo "Table token Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('token', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('client',32);
            $table->unsignedInteger('client_id');
            $table->string('access_token',64);
            $table->dateTime('expires_at');
            $table->string('refresh_token',64);
            $table->string('scope',128)->default('');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->index(['client','client_id']);
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `token` (
        // `id` int unsigned not null auto_increment primary key,
        // `client` varchar(32) not null,
        // `client_id` int unsigned not null,
        // `access_token` varchar(64) not null,
        // `expires_at` datetime not null,
        // `refresh_token` varchar(64) not null,
        // `scope` varchar(128) not null default '',
        // `created_at` datetime not null default CURRENT_TIMESTAMP,
        // `updated_at` datetime null ON UPDATE CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `token` add index `token_client_client_id_index`(`client`, `client_id`)
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
        Schema::dropIfExists('token');
    }
}
