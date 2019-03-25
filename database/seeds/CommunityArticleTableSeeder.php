<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunityArticleTableSeeder extends Seeder
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
        $userIds = User::pluck('id');

        foreach (range(1, 20) as $index) {
            $dataList[] = [
                'title'      => $faker->sentence(2), // nbWords 可以控制句子长度
                'main_body'  => $faker->paragraph,
                'user_id'    => $faker->randomElement($userIds),
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }

        DB::table('community_articles')->insert($dataList);
    }
}
