<?php

namespace App\Http\Controllers;
use App\User;
use App\Auther;
use Illuminate\Http\Request;

class AuthersController extends Controller {

    public function getAutherProfile(Auther $auther,User $user) {
        return view('authers.autherProfile', compact('auther','user'));
    }

    public function autherFollowing(Auther $auther) {
        $userId = auth()->user()->id;
        if ($auther->user_is_following_auther) {
            $auther->users()->detach($userId);
        } else {
            $auther->users()->attach($userId, ['type' => 'auther']);
        }
        return redirect('/home');
    }

}
