<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $userList = [];

        $length = rand(5, 20);
        for ($i = 0; $i < $length; $i++) {
            $userList[] = [
                'name'              => $faker->name,
                'email'             => $faker->email,
                'email_verified_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'phone'             => $faker->phoneNumber,
                'phone_verified_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'password'          => $faker->password,
                'avatar'            => $faker->imageUrl(),
                'api_token'         => Str::random(32),
                'remember_token'    => Str::random(32),
                'created_at'        => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at'        => $faker->dateTimeBetween('-1 years', 'now')
            ];
        }

        DB::table('user')->insert($userList);
    }
}
