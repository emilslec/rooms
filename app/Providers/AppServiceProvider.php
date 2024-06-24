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
        Gate::define('join-room', function (User $user) {

            if ($user && Participant::where('user_id', $user->id)->exists()) {
                return false;
            }
            return true;
        });
    }
}
