<?php

namespace Tests\Feature\Http\Controllers;

use App\Constants\Size;
use App\Models\Website;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * Test can create post
     *
     * @return void
     */
    public function test_can_create_post_with_valid_data()
    {
        $website = Website::factory()->make();
        $website->save();

        $post = [
            'title' => 'This is a test title.',
            'description' => 'This is a test description.',
        ];

        $response = $this->postJson("/api/websites/{$website->id}/posts", $post);

        # Test post was created successfully
        $response
            ->assertStatus(201)
            ->assertJsonPath('title', $post['title'])
            ->assertJsonPath('description', $post['description']);
    }

    /**
     * Test can validate project
     *
     * @return void
     */
    public function test_can_validate_length_of_title_and_description_of_post()
    {
        $website = Website::factory()->make();
        $website->save();

        $post = [
            'title' => fake()->words(Size::POST_TITLE, true),
            'description' => fake()->words(Size::POST_DESCRIPTION, true),
        ];

        $response = $this->postJson("/api/websites/{$website->id}/posts", $post);

        # Test post failed
        $response->assertStatus(422);
    }
}
