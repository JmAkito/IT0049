<?php

namespace App\Http\Controllers;

use App\Models\User;

class PageController extends Controller
{
    public function profile()
    {
        $user = User::first();

        return view('profile', compact('user'));
    }

    public function about()
    {
        return view('about');
    }
}