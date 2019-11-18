<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('password_reset')) {
            echo "Table password_reset Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('password_reset', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->string('email', 64)->index();
            $table->string('token', 64);
            $table->dateTime('created_at')->useCurrent();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `password_reset` (
        // `email` varchar(255) not null,
        // `token` varchar(255) not null,
        // `created_at` datetime not null default CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `password_reset` add index `password_reset_email_index`(`email`)
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
        Schema::dropIfExists('password_reset');
    }
}
