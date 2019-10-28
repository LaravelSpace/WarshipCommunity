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
        $userIdList = User::pluck('id');

        $length = rand(1, 50);
        for ($i = 0; $i < $length; $i++) {
            $articleList[] = [
                'title'      => $faker->sentence(2),
                'body'       => Str::random(32),
                'user_id'    => $faker->randomElement($userIdList),
                'examine'    => rand(0, 3),
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }

        DB::table('articles')->insert($articleList);
    }
}
