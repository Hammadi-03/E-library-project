<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        $supported = ['id', 'en', 'ar'];

        if (in_array($locale, $supported)) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
