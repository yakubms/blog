<?php

namespace Acme;

use Carbon\Carbon;
use October\Rain\Database\Updates\Seeder;
use RainLab\Blog\Models\Post;
use SaurabhDhariwal\Comments\Models\Comments;

class SeedComments extends Seeder
{
    const COMMENTS = 8000;
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
    }

    public function run()
    {
        $comments = $this->createComments(self::COMMENTS);
        \Db::table('saurabhdhariwal_comments_posts')->insert($comments);
        echo "done.\n";
    }

    private function createComments($commentCounts)
    {
        $array = [];
        $post = Post::all();
        for ($i = 0; $i < $commentCounts; $i++) {
            // $url = 'post/' . Post::all()->random()->slug;
            $parentId = $this->getParentId($i);
            $url = $this->getUrl($post, $array, $parentId);
            $author = $this->faker->name();
            $email = $this->faker->email();
            $content = $this->faker->sentence();
            $date = $this->getDate($post, $array, $parentId);
            $array[] = [
                'author' => $author,
                'parent_id' => $parentId,
                'email' => $email,
                'content' => $content,
                'status' => 1,
                'url' => $url,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        return $array;
    }

    private function getParentId($max)
    {
        if ($this->faker->randomNumber(1) % 3 or $max == 0) {
            return null;
        }
        return $this->faker->numberBetween(1, $max);
        // return Comments::all()->random()->id;
    }

    private function getUrl($post, $array, $parentId)
    {
        if (!$parentId) {
            return 'post/' . $post->random()->slug;
        }
        return $array[$parentId - 1]['url'];
    }

    private function getDate($post, $array, $parentId)
    {
        if (!$parentId) {
            return $this->faker->dateTimeBetween('-2 years', 'now', 'Asia/Tokyo')->format('Y-m-d h:i:s');
        }
        $parentDate = new Carbon($array[$parentId - 1]['created_at']);
        return $parentDate->addDays($this->faker->randomNumber(1));
        // return $this->faker->dateTimeBetween($parentDate, 'now', 'Asia/Tokyo')->format('Y-m-d h:i:s');
    }
}
