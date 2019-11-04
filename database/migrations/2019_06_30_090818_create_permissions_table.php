<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('permissions')) {
            echo "Table permissions Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('permissions', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 64)->unique(); // 权限名称
            $table->string('describe',255)->nullable(); // 描述
            $table->dateTime('created_at')->useCurrent();
        });
        // \Log::debug(\DB::getQueryLog());

        // create table `permissions` (
        // `id` int unsigned not null auto_increment primary key,
        // `name` varchar(64) not null,
        // `describe` varchar(255) null,
        // `created_at` datetime not null default CURRENT_TIMESTAMP
        // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'

        // alter table `permissions` add unique `permissions_name_unique`(`name`)
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
        Schema::dropIfExists('permissions');
    }
}
