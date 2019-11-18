<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensitiveResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sensitive_result')) {
            echo "Table sensitive_result Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('sensitive_result', function (Blueprint $table) {
            $table->increments('id');
            $table->string('classification', 64); // 目标类型
            $table->unsignedInteger('target_id'); // 目标 id
            $table->string('result_data', 255);
            $table->dateTime('created_at')->useCurrent();
            $table->index(['classification', 'target_id']);
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `sensitive_result` (
        // `id` int unsigned not null auto_increment primary key,
        // `classification` varchar(64) not null,
        // `target_id` int unsigned not null,
        // `result_data` varchar(255) not null,
        // `created_at` datetime not null default CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `sensitive_result` add index `sensitive_result_classification_target_id_index`(`classification`, `target_id`)
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
        Schema::dropIfExists('sensitive_result');
    }
}
