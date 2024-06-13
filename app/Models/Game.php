<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'year', 'type'];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
