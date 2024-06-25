<?php

namespace App\Providers;

use App\Models\Participant;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('join-room', function (User $user, Room $room) {

            if (($user && Participant::where('user_id', $user->id)->exists()) || Participant::where('room_id', $room->id)->count() >= $room->limit) {
                return false;
            }
            return true;
        });

        Gate::define('create-room', function (User $user) {

            if ($user && Participant::where('user_id', $user->id)->exists()) {
                return false;
            }
            return true;
        });

        Gate::define('leave-room', function (User $user, Room $room) {

            if (Participant::where('user_id', $user->id)->where('room_id', $room->id)->exists()) {
                return true;
            }
            return false;
        });
    }
}
