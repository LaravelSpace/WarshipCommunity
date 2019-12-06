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

        $length = 200;
        for ($i = 0; $i < $length; $i++) {
            $key = Str::random(32);
            $userId = $faker->randomElement($userIdList);
            $commentList[] = [
                'body'       => $key,
                'user_id'    => $userId,
                'article_id' => $faker->randomElement($articleIdList),
                'examine'    => 2,
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now')
            ];

            $bodyList[] = [
                'body'    => $faker->text,
                'key'     => $key,
                'user_id' => $userId
            ];
        }

        $handler = new \App\Service\Community\Article\Handler\CommentHandler();
        foreach ($bodyList as $item) {
            $handler->saveToFile($item['user_id'], $item['key'], $item['body']);
        }

        DB::table('comment')->insert($commentList);
    }
}
