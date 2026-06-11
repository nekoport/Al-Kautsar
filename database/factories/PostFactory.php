<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'content' => fake()->paragraphs(3, true),
            'excerpt' => fake()->sentence(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'published_at' => now(),
        ];
    }
}
