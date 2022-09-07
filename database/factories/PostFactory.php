<?php

namespace Database\Factories;

use App\Constants\Size;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(Size::POST_TITLE),
            'description' => fake()->text(Size::POST_DESCRIPTION),
            'website_id' => fake()->randomElement(Website::all())['id']
        ];
    }
}
