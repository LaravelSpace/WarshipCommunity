<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('role_permission')) {
            echo 'Table role_permission Is Already Exist!' . PHP_EOL;
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('role_permission', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');
            $table->dateTime('created_at')->useCurrent();
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
        Schema::dropIfExists('role_permission');
    }
}
