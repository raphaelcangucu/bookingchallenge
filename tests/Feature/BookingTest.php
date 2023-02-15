<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_booking_get()
    {
        $response = $this->getJson('/api/booking/1');

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('id', 1)
                ->where('room_id', 1)
                ->etc()
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_booking_post()
    {
        $response = $this->postJson('/api/booking', [
            'room_id' => 3,
            'starts_at' => '2025-01-01',
            'ends_at' => '2025-01-05',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                ->where('room_id', 3)
                ->where('starts_at', '2025-01-01')
                ->where('ends_at', '2025-01-05')
                ->etc()
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_booking_put()
    {
        $response = $this->putJson('/api/booking/1', [
            'room_id' => 3,
            'starts_at' => '2025-01-10',
            'ends_at' => '2025-01-15',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json
                ->where('room_id', 3)
                ->where('starts_at', '2025-01-10')
                ->where('ends_at', '2025-01-15')
                ->etc()
            );
    }
}
