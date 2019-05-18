<?php

namespace App\Http\Controllers;

use App\InstagramAccount;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $instagramAccounts = InstagramAccount::whereUserId(\Auth::user()->id)->get();

        return view('home', compact('instagramAccounts'));
    }
}
