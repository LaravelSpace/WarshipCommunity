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
        $avatarList = [
            'default_avatar.jpg',
            'lex.jpg',
            'mao.jpg',
            'mao_remake.jpg',
            'ougen.jpg',
            'quincy.jpg',
            'vv.jpg',
        ];
        for ($i = 0; $i < 10; $i++) {
            $tempName = 'xhy_' . ($i + 1);
            $tempEmail = $tempName . '@sina.com';
            $userList[] = [
                'name'              => $tempName,
                'email'             => $tempEmail,
                'email_verified_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'phone'             => $faker->phoneNumber,
                'phone_verified_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'password'          => Hash::make('123456'),
                'avatar'            => '/image/avatar/' . $avatarList[array_rand($avatarList)],
                'api_token'         => Str::random(32),
                'remember_token'    => Str::random(32),
                'created_at'        => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at'        => $faker->dateTimeBetween('-1 years', 'now')
            ];
        }

        DB::table('user')->insert($userList);
    }
}
