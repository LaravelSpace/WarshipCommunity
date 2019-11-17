<?php

use App\Service\Community\Article\Model\Article;
use App\Service\User\Model\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $bodyList = [];
        $userIdList = User::pluck('id');
        $articleIdList = Article::pluck('id');

        $length = rand(50, 200);
        for ($i = 0; $i < $length; $i++) {
            $key = Str::random(32);
            $userId = $faker->randomElement($userIdList);
            $articleId = $faker->randomElement($articleIdList);
            $commentList[] = [
                'body'       => $key,
                'user_id'    => $userId,
                'article_id' => $articleId,
                'examine'    => rand(0, 3),
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now')
            ];

            $bodyList[] = [
                'body'       => $faker->text,
                'key'        => $key,
                'user_id'    => $userId,
                'article_id' => $articleId
            ];
        }

        DB::table('comments')->insert($commentList);
    }
}
