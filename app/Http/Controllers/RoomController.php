<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Game;
use App\Models\User;
use App\Models\Participant;
use App\Models\Message;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;



class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Auth::loginUsingId(5);
        //  App::setLocale('lv');
        $participants = Participant::all()->where('status', 1)->pluck('room_id'); //->value('user_id');
        $rooms = Room::all()->whereIn('id', $participants);
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
        if ($request->title == null || $request->description == null || $request->level == null || $request->game_id == null || $request->limit == null) {
            //if you deleted everyting - go back and fill it!            
            return redirect()->route('rooms.index');
        }

        if ($request->limit <= 0) {
            return redirect()->route('rooms.index');
        }

        if (!Gate::allows('create-room')) {
            abort(403);
        }

        $s = Room::create([
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'game_id' => $request->game_id,
            'limit' => $request->limit,
        ]);
        Participant::create(['user_id' => Auth()->user()->id, 'room_id' => $s->id]);
        return redirect()->route('rooms.show', $s->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $room = Room::find($id);
        $participants = Participant::all()->where('room_id', $id)->where('status', 1)->pluck('user_id'); //->value('user_id');
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
        $r = Room::find($id);
        if ($r->participantCount() > 0) {
            Participant::create(['user_id' => auth()->user()->id, 'room_id' => $id, 'status' => 1]);
        }
        return redirect()->route('rooms.show', $id);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('leave-room', Room::findOrFail($id))) {
            abort(403);
        }
        $u = User::find(Auth()->user()->id);
        $p = $u->latestParticipant;
        if ($p != null) {
            $p->status = 0;
            $p->save();
        }
        if (!Participant::where('room_id', $id)->exists()) {
            Room::findOrfail($id)->delete();
        }
        return redirect()->route('rooms.index');
    }

    public function lang($locale)
    {
        $supportedLocales = ['en', 'lv', 'fr']; // Add more as needed

        if (in_array($locale, $supportedLocales)) {
            Session::put('locale', $locale);
            app()->setLocale($locale);
        }

        return redirect()->back(); // Redirect back to the previous page
    }
}
