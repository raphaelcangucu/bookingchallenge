<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Booking::factory()->count(3)
            ->create(
                [
                    'room_id' => 1,
                    'starts_at' => '2023-01-01',
                    'ends_at' => '2023-01-05',
                ]
            );

        Booking::factory()
            ->create(
                [
                    'room_id' => 2,
                    'starts_at' => '2023-01-01',
                    'ends_at' => '2023-01-05',
                ]
            );

        Booking::factory()
            ->create(
                [
                    'room_id' => 3,
                    'starts_at' => '2023-01-03',
                    'ends_at' => '2023-01-08',
                ]
            );
    }
}
