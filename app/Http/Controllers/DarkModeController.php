<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class DarkModeController extends Controller
{
    public function toggle()
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            Auth::user()->update(['dark_mode' => !Auth::user()->dark_mode]);
        }

        return back();
    }
}
