<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('jobs')) {
            echo "Table jobs Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `jobs` (
        // `id` bigint unsigned not null auto_increment primary key,
        // `queue` varchar(255) not null,
        // `payload` longtext not null,
        // `attempts` tinyint unsigned not null,
        // `reserved_at` int unsigned null,
        // `available_at` int unsigned not null,
        // `created_at` int unsigned not null
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `jobs` add index `jobs_queue_index`(`queue`)
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
        Schema::dropIfExists('jobs');
    }
}
