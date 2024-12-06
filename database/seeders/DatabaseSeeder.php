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
        Game::create(['title' => 'Any', 'year' => 2999, 'type' => 'default']);
        Game::create(['title' => 'Fortnite', 'year' => 2069, 'type' => 'sus']);
        Game::create(['title' => 'Among us', 'year' => 2069, 'type' => 'very sus']);
        Game::create(['title' => 'CSGO', 'year' => 2010, 'type' => 'big gamin']);
        Game::create(['title' => 'Rocket League', 'year' => 2008, 'type' => 'bolls']);
        Game::create(['title' => 'Minecraft', 'year' => 2002, 'type' => 'minecraeft']);

        $cs = Game::orderBy('id', 'desc')->first();
        $cs->rooms()->create(
            ['title' => 'Master gamers', 'description' => 'We are the best, we ball', 'level' => 999, 'limit' => 4],
            ['title' => 'bad boyus', 'description' => 'fun is what we have', 'level' => 3, 'limit' => 4],
        );
        Room::create(['title' => 'bad boyus', 'description' => 'fun is what we have', 'level' => 3, 'limit' => 4, 'game_id' => 1]);

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
        Participant::create(['user_id' => '4', 'room_id' => '1']);


        User::create(['name' => 'a', 'email' => 'a@a', 'password' => 'az', 'isAdmin' => '1']);

        Message::create([
            'user_id' => User::orderBy('id', 'desc')->first()->id,
            'room_id' => Room::orderBy('id', 'desc')->first()->id,
            'content' => 'sveiki zeni., kas te lebs moitiek'
        ]);
    }
}
