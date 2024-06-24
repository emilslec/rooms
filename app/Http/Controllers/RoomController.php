<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Game;
use App\Models\User;
use App\Models\Participant;
use App\Models\Message;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Auth::loginUsingId(5);
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $games = Game::all();
        return view('rooms.create', compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->title == null || $request->description == null || $request->level == null || $request->game_id == null) {
            //if you deleted everyting - go back and fill it!            
            return redirect()->route('rooms.index');
        }

        Room::create([
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'game_id' => $request->game_id
        ]);
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $room = Room::find($id);
        $participants = Participant::all()->where('room_id', $id)->pluck('user_id'); //->value('user_id');
        $users = User::all()->whereIn('id', $participants);
        $messages = Message::all()->where('room_id', $id);
        return view('rooms.show', compact('room', 'users', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('join-room', Room::find($id))) {
            abort(403);
        }


        if ($request->user_id == null || $request->room_id == null) {
            return redirect()->route('rooms.index');
        }
        Participant::create(['user_id' => auth()->user()->id, 'room_id' => $id]);
        return redirect()->route('posts.index'); //, $id);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
