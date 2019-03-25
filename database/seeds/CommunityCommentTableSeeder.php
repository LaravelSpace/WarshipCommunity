<?php

use App\Community\Article\Model\Article;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunityCommentTableSeeder extends Seeder
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
        $articleIds = Article::pluck('id');

        foreach (range(1, 50) as $index) {
            $dataList[] = [
                'main_body'  => $faker->paragraph,
                'user_id'    => $faker->randomElement($userIds),
                'article_id' => $faker->randomElement($articleIds),
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }

        DB::table('community_comments')->insert($dataList);
    }
}
