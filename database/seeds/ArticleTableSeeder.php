<?php

use App\Service\User\Model\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $userIdList = UserModel::pluck('id');

        $articleList = [];
        $bodyList = [];

        for ($i = 0; $i < 50; $i++) {
            $key = Str::random(32);
            $userId = $faker->randomElement($userIdList);
            $articleList[] = [
                'title'      => $faker->sentence(4),
                'body'       => $key,
                'user_id'    => $userId,
                'examine'    => 1,
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
            $bodyList[] = [
                'body'    => $faker->text,
                'key'     => $key,
                'user_id' => $userId,
            ];
        }

        $handler = new \App\Service\Community\Article\Handler\ArticleHandler();
        foreach ($bodyList as $item) {
            $dirPath = config('constant.file_path.article_storage') . $item['user_id'] . '/';
            $dirPath = storage_path($dirPath);
            $fileName = $item['key'] . '.txt';
            $handler->saveToFile($dirPath, $fileName, $item['body']);
        }

        DB::table('article')->insert($articleList);
    }
}
