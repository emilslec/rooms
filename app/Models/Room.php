<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['title', 'description', 'level', 'game_id'];
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
