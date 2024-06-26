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
            if (($user && $user->latestParticipant && $user->latestParticipant->status == 1) ||
                $room->participantCount() >= $room->limit
            ) {
                return false;
            }
            return true;
        });

        Gate::define('create-room', function (User $user) {

            if ($user && $user->latestParticipant && $user->latestParticipant->status == 1) {
                return false;
            }
            return true;
        });

        Gate::define('leave-room', function (User $user, Room $room) {

            if ($user->latestParticipant && $user->latestParticipant->status == 1 && $user->latestParticipant->room_id == $room->id) {
                return true;
            }
            return false;
        });
    }
}
