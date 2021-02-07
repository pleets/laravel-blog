<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $slug = $this->faker->slug;

        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
            'description' => $this->faker->paragraph(4),
            'image' => $this->faker->imageUrl(60, 480),
            'url_path' => $slug,
            'url_hash' => hash('md5', $slug),
            'published_at' => now(),
        ];
    }
}
