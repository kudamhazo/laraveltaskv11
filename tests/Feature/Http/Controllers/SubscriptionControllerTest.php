<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Website;
use Tests\TestCase;

class SubscriptionControllerTest extends TestCase
{
    /**
     * Test user can subscribe to website
     *
     * @return void
     */
    public function test_user_can_subscribe_to_website()
    {
        $website = Website::factory()->make();
        $website->save();
        $user = User::factory()->make();
        $user->save();

        $body = [
            'email' => $user->email,
        ];

        $response = $this->postJson("/api/websites/{$website->id}/subscriptions", $body);

        # Test post was created successfully
        $response
            ->assertStatus(201)
            ->assertJson(['subscribed' => true]);

    }
    // TODO Add more robust test. Not enough tests for checking failing subscriptions
}
