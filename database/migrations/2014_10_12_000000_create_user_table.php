<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('user')) {
            echo "Table user Is Already Exist! \n";
            return;
        }
        // \DB::connection()->enableQueryLog();
        Schema::create('user', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->increments('id');
            $table->string('name', 32)->unique();
            $table->string('email', 32)->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('phone', 32)->unique();
            $table->dateTime('phone_verified_at')->nullable();
            $table->string('password', 64);
            $table->string('avatar', 128);
            $table->string('api_token', 64);
            $table->string('remember_token', 64);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
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
        Schema::dropIfExists('user');
    }
}
