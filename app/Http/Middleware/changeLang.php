<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class changeLang
{

    public function handle(Request $request, Closure $next)
    {
        if (Session::get('locale')) {
            app()->setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
