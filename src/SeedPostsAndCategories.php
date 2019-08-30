<?php

namespace Acme;

use Carbon\Carbon;
use October\Rain\Database\Updates\Seeder;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;

class SeedPostsAndCategories extends Seeder
{
    const CATEGORIES = 20;
    const POSTS = 500;

    private $faker;
    private $parsedown;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
        $this->faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($this->faker));
        $this->parsedown = new \Parsedown();
    }

    public function run()
    {
        $this->createCategories(self::CATEGORIES);
        $this->createPosts(self::POSTS, self::CATEGORIES);

        echo "done.\n";
    }

    private function getCategory()
    {
        while (true) {
            $category = $this->faker->word();
            if ($this->isValidCategory($category)) {
                return $category;
            }
        }
    }

    private function isValidCategory($category)
    {
        return strlen($category) >= 3 &&
        ! Category::where('name', $category)->exists();
    }

    private function createCategories($count)
    {
        for ($i = 0; $i < $count; $i++) {
            $category = $this->getCategory();
            Category::create([
                'name' => $category,
                'slug' => $category,
            ]);
        }
    }

    private function createPosts($posts, $categories)
    {
        for ($i = 0; $i < $posts; $i++) {
            $title = $this->faker->sentence(5);
            $content = $this->faker->markdown();
            $date = $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d h:i:s');

            Post::create([
                'user_id' => 1,
                'title' => $title,
                'slug' => str_slug($title, '-'),
                'excerpt' => '',
                'content' => $content,
                'content_html' => $this->parsedown->text($content),
                'published_at' => $date,
                'published' => true,
            ])->categories()->sync([$this->faker->numberBetween(1, $categories), $this->faker->numberBetween(1, $categories)]);
        }
    }
}
