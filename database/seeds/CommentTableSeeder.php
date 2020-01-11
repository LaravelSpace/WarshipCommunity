<?php

use App\Service\Community\Article\Model\ArticleModel;
use App\Service\Community\Article\Model\CommentModel;
use App\Service\User\Model\UserModel;
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
        $userIdList = UserModel::pluck('id');
        $articleIdList = ArticleModel::pluck('id');

        $length = 1000;
        $articleFloorList = [];
        for ($i = 0; $i < $length; $i++) {
            $key = Str::random(32);
            $userId = $faker->randomElement($userIdList);
            $articleId = $faker->randomElement($articleIdList);
            $listKey = 'article-' . $articleId;
            if (isset($articleFloorList[$listKey])) {
                $articleFloorList[$listKey] += 1;
                $articleFloor = $articleFloorList[$listKey];
            } else {
                $whereField = ['article_id' => $articleId];
                $articleFloorList[$listKey] = CommentModel::query()->where($whereField)->count();
                $articleFloorList[$listKey] += 1;
                $articleFloor = $articleFloorList[$listKey];
            }
            $commentList[$listKey][] = [
                'body'          => $key,
                'user_id'       => $userId,
                'article_id'    => $articleId,
                'article_floor' => $articleFloor,
                'examine'       => 2,
                'blacklist'     => $faker->boolean,
                'created_at'    => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at'    => $faker->dateTimeBetween('-1 years', 'now')
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

        foreach ($commentList as $comment) {
            DB::table('comment')->insert($comment);
        }
    }
}
