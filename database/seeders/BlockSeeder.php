<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Block::factory()
            ->create(
                [
                    'room_id' => 2,
                    'starts_at' => '2023-01-01',
                    'ends_at' => '2023-01-10',
                ]
            );
    }
}
