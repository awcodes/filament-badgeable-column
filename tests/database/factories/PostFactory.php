<?php

declare(strict_types=1);

namespace Awcodes\BadgeableColumn\Tests\Database\Factories;

use Awcodes\BadgeableColumn\Tests\Fixtures\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'is_published' => $this->faker->boolean(),
        ];
    }
}
