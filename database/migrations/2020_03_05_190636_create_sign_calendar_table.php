<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sign_calendar')) {
            echo 'Table sign_calendar Is Already Exist!' . PHP_EOL;
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('sign_calendar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->date('sign_date');
            $table->dateTime('created_at')->useCurrent();
            $table->index(['user_id', 'sign_date']);
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
        Schema::dropIfExists('sign_calendar');
    }
}
