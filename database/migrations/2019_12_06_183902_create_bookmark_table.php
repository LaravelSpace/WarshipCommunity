<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('bookmark')) {
            echo "Table bookmark Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('bookmark', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('classification', 64);
            $table->unsignedInteger('target_id');
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
        Schema::dropIfExists('bookmark');
    }
}
