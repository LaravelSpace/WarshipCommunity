<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('roles')) {
            echo "Table roles Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('roles', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 64)->unique(); // 角色名称
            $table->string('describe', 255)->nullable(); // 描述
            $table->dateTime('created_at')->useCurrent();
        });
        // \Log::debug(\DB::getQueryLog());.

        // create table `roles` (
        // `id` int unsigned not null auto_increment primary key,
        // `name` varchar(64) not null,
        // `describe` varchar(255) null,
        // `created_at` datetime not null default CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `roles` add unique `roles_name_unique`(`name`)
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
        Schema::dropIfExists('roles');
    }
}
