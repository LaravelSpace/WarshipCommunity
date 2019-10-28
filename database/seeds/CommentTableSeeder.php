<?php

use App\Service\Community\Article\Model\Article;
use App\Service\User\Model\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $commentList = [];
        $userIdList = User::pluck('id');
        $articleIdList = Article::pluck('id');
        $length = rand(1, 200);
        for ($i = 0; $i < $length; $i++) {
            $commentList[] = [
                'body'       => $faker->paragraph,
                'user_id'    => $faker->randomElement($userIdList),
                'article_id' => $faker->randomElement($articleIdList),
                'examine'    => rand(0, 3),
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }

        DB::table('comments')->insert($commentList);
    }
}
