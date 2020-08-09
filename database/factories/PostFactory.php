<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $slug = $faker->slug;

    return [
        'category_id' => function () {
            return factory(Category::class)->create()['category_id'];
        },
        'title' => $faker->title,
        'content' => $faker->paragraph,
        'description' => $faker->paragraph(4),
        'image' => $faker->imageUrl(60, 480),
        'url_path' => $slug,
        'url_hash' => hash('md5', $slug),
        'published_at' => now(),
    ];
});
