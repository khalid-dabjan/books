<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{

    public function getFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }

}