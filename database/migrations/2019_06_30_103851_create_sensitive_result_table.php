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
            $table->string('result_data', 255)->nullable()->default('');
            $table->dateTime('created_at')->useCurrent();
            $table->index(['classification', 'target_id']);
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
        Schema::dropIfExists('sensitive_result');
    }
}
