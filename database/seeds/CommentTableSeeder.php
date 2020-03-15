<?php

use App\Service\Community\Article\Model\ArticleModel;
use App\Service\Community\Article\Model\CommentModel;
use App\Service\User\Model\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $userIdList = UserModel::pluck('id');
        $articleIdList = ArticleModel::pluck('id');

        $commentList = [];
        $bodyList = [];
        $articleFloorList = [];
        for ($i = 0; $i < 500; $i++) {
            $key = Str::random(32);
            $userId = $faker->randomElement($userIdList);
            $articleId = $faker->randomElement($articleIdList);
            $listKey = 'article-' . $articleId;
            if (isset($articleFloorList[$listKey])) {
                $articleFloorList[$listKey] += 1;
                $articleFloor = $articleFloorList[$listKey];
            } else {
                $whereField = ['article_id' => $articleId];
                $articleFloorList[$listKey] = CommentModel::where($whereField)->count();
                $articleFloorList[$listKey] += 1;
                $articleFloor = $articleFloorList[$listKey];
            }
            $commentList[$listKey][] = [
                'body'          => $key,
                'user_id'       => $userId,
                'article_id'    => $articleId,
                'article_floor' => $articleFloor,
                'examine'       => 1,
                'blacklist'     => $faker->boolean,
                'created_at'    => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at'    => $faker->dateTimeBetween('-1 years', 'now'),
            ];
            $bodyList[] = [
                'body'    => $faker->text,
                'key'     => $key,
                'user_id' => $userId,
            ];
        }

        $handler = new \App\Service\Community\Article\Handler\CommentHandler();
        foreach ($bodyList as $item) {
            $dirPath = config('constant.file_path.comment_storage') . $item['user_id'] . '/';
            $dirPath = storage_path($dirPath);
            $fileName = $item['key'] . '.txt';
            $handler->saveToFile($dirPath, $fileName, $item['body']);
        }

        foreach ($commentList as $itemComment) {
            DB::table('comment')->insert($itemComment);
        }
    }
}
