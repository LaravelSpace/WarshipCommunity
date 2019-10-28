<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensitiveResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasTable('sensitive_results')) {
            echo "Table sensitive_results Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('sensitive_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('target_id');
            $table->string('classification', 64);
            $table->string('result_data');
            $table->timestamps();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `sensitive_results` (
        // `id` int unsigned not null auto_increment primary key,
        // `target_id` int unsigned not null,
        // `classification` varchar(64) not null,
        // `result_data` varchar(255) not null,
        // `created_at` timestamp null,
        // `updated_at` timestamp null
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
        Schema::dropIfExists('sensitive_results');
    }
}
