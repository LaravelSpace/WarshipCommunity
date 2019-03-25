<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $dataList = [];

        foreach (range(1, 10) as $index) {
            $dataList[] = [
                'name'              => $faker->name,
                'email'             => $faker->email,
                'email_verified_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'password'          => $faker->password,
                'remember_token'    => str_random(64),
                'avatar'            => $faker->imageUrl(),
                'created_at'        => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at'        => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }

        DB::table('users')->insert($dataList);
    }
}
