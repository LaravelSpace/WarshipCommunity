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
            echo "Table role_permission Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('role_permission', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `role_permission` (
        // `id` int unsigned not null auto_increment primary key,
        // `permission_id` int unsigned not null,
        // `role_id` int unsigned not null,
        // `created_at` timestamp default CURRENT_TIMESTAMP null,
        // `updated_at` timestamp ON UPDATE CURRENT_TIMESTAMP null
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
        Schema::dropIfExists('role_permission');
    }
}
