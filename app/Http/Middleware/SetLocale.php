<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Supported languages
        $supportedLocales = ['id', 'en', 'ar'];

        // Get locale from session, default to 'id' (Indonesian)
        $locale = Session::get('locale', config('app.locale', 'id'));

        // Make sure it's a valid locale
        if (!in_array($locale, $supportedLocales)) {
            $locale = 'id';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
