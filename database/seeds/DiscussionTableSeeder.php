<?php

use App\Service\Community\Article\Model\CommentModel;
use App\Service\User\Model\UserModel;
use Illuminate\Database\Seeder;

class DiscussionTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $userIdList = UserModel::pluck('id');
        $commentIdList = CommentModel::pluck('id');

        $discussionList = [];
        for ($i = 0; $i < 500; $i++) {
            $commentId = $faker->randomElement($commentIdList);
            $listKey = 'discussion-' . $commentId;
            $discussionList[$listKey] = [
                'body'       => $faker->sentence(3),
                'user_id'    => $faker->randomElement($userIdList),
                'comment_id' => $commentId,
                'examine'    => 1,
                'blacklist'  => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ];
        }

        foreach ($discussionList as $itemDiscussion) {
            DB::table('discussion')->insert($itemDiscussion);
        }
    }
}
