<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Game;
use App\Models\Room;
use App\Models\Message;
use App\Models\Participant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Game::create(['name' => 'CS2', 'year' => 2023, 'type' => 'FPS shooter']);

        $cs = Game::orderBy('id', 'desc')->first();
        $cs->rooms()->createMany([
            ['name' => 'Master gamers', 'description' => 'We are the best, we ball', 'level' => 999],
            ['name' => 'bad boyus', 'description' => 'fun is what we have', 'level' => 3],
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Participant::create(
            [
                'user_id' => User::orderBy('id', 'desc')->first()->id,
                'room_id' => Room::orderBy('id', 'desc')->first()->id
            ]
        );

        Message::create([
            'user_id' => User::orderBy('id', 'desc')->first()->id,
            'room_id' => Room::orderBy('id', 'desc')->first()->id,
            'content' => 'sveiki zeni., kas te lebs moitiek'
        ]);
    }
}
