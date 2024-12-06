<?php

namespace App\Models;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'level', 'game_id', 'limit'];

    // @return int
    public function participantCount(): int
    {
        return Participant::where('status', 1)->where('room_id', $this->id)->count();
    }
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
