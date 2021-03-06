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
            echo 'Table log_request Is Already Exist!' . PHP_EOL;
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('log_request', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->bigIncrements('id');
            $table->string('ip', 32);
            $table->string('client', 32);
            $table->unsignedInteger('client_id');
            $table->string('controller', 64);
            $table->string('action', 64);
            $table->string('request', 64);
            $table->string('response', 64)->nullable()->default('');
            $table->unsignedInteger('consumption')->nullable()->default(0);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->index(['controller', 'action']);
            $table->index(['client', 'client_id', 'controller', 'action']);
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
            echo 'Not In Local Environment!' . PHP_EOL;
            return;
        }
        Schema::dropIfExists('log_request');
    }
}
