<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;

use Tests\TestCase;

class OccupancyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_daily_get()
    {
        $response = $this->getJson('/api/daily-occupancy-rates/2023-1-2');

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('occupancy_rate', 0.36)
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_monthly_get()
    {
        $response = $this->getJson('/api/monthly-occupancy-rates/2023-1');

        $response
            ->assertStatus(200)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('occupancy_rate', 0.07)
            );
    }
}
