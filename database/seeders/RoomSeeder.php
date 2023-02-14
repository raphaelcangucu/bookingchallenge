<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::factory()
            ->create(
                [
                    'id' => 1,
                    'capacity' => 6,
                ]
            );

        Room::factory()
            ->create(
                [
                    'id' => 2,
                    'capacity' => 4,
                ]
            );

        Room::factory()
            ->create(
                [
                    'id' => 3,
                    'capacity' => 2,
                ],
            );
    }
}
