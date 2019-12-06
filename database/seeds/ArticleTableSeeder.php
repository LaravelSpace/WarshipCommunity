<?php

use App\Service\User\Model\User;

;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $articleList = [];
        $bodyList = [];
        $userIdList = User::pluck('id');

        $length = 20;
        for ($i = 0; $i < $length; $i++) {
            $key = Str::random(32);
            $userId = $faker->randomElement($userIdList);
            $articleList[] = [
                'title'      => $faker->sentence(2),
                'body'       => $key,
                'user_id'    => $userId,
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

        $handler = new \App\Service\Community\Article\Handler\ArticleHandler();
        foreach ($bodyList as $item) {
            $handler->saveToFile($item['user_id'], $item['key'], $item['body']);
        }

        DB::table('article')->insert($articleList);
    }
}
