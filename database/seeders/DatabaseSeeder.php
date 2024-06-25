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
        Game::create(['title' => 'CS2', 'year' => 2023, 'type' => 'FPS shooter']);
        Game::create(['title' => 'amog', 'year' => 2019, 'type' => 'sus']);

        $cs = Game::orderBy('id', 'desc')->first();
        $cs->rooms()->createMany([
            ['title' => 'Master gamers', 'description' => 'We are the best, we ball', 'level' => 999, 'limit' => 0],
            ['title' => 'bad boyus', 'description' => 'fun is what we have', 'level' => 3, 'limit' => 4],
        ]);

        User::factory()->count(5)->create();

        $r = Room::orderBy('id', 'desc')->first();
        $r->participants()->createMany([
            ['user_id' => '3'],
            ['user_id' => '2'],
            ['user_id' => '1']
        ]);
        $r->messages()->createMany([
            ['user_id' => '1', 'content' => 'jajaja'],
            ['user_id' => '2', 'content' => 'janka'],
            ['user_id' => '3', 'content' => 'pecha']
        ]);




        Message::create([
            'user_id' => User::orderBy('id', 'desc')->first()->id,
            'room_id' => Room::orderBy('id', 'desc')->first()->id,
            'content' => 'sveiki zeni., kas te lebs moitiek'
        ]);
    }
}
