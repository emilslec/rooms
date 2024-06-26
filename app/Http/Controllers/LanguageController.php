<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function update($locale)
    {
        $supportedLocales = ['en', 'lv', 'fr']; // Add more as needed

        if (in_array($locale, $supportedLocales)) {
            Session::put('locale', $locale);
            app()->setLocale(Session::get('locale'));
        }

        return redirect()->back(); // Redirect back to the previous page
    }
}
