<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('failed_jobs')) {
            echo "Table failed_jobs Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `failed_jobs` (
        // `id` bigint unsigned not null auto_increment primary key,
        // `connection` text not null,
        // `queue` text not null,
        // `payload` longtext not null,
        // `exception` longtext not null,
        // `failed_at` timestamp default CURRENT_TIMESTAMP not null
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
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
        Schema::dropIfExists('failed_jobs');
    }
}
