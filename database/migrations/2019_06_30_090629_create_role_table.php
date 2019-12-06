<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('role')) {
            echo "Table role Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('role', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 64)->unique();
            $table->string('describe', 255)->nullable()->default('');
            $table->dateTime('created_at')->useCurrent();
        });
        // \Log::debug(\DB::getQueryLog());.
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
        Schema::dropIfExists('role');
    }
}
