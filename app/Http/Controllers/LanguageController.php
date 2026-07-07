<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang(Request $request, $lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            Session::put('applocale', $lang);
            if (Auth::check()) {
                $user = Auth::user();
                $user->lang = $lang;
                $user->save();
            }
        }
        return redirect()->back();
    }
}
