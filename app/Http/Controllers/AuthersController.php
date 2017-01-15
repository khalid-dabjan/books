<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Auther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\BookMatch;

class AuthersController extends Controller {

    public function getAutherProfile(Auther $auther, User $user) {
        return view('authers.autherProfile', compact('auther', 'user'));
    }

    public function autherFollowing(Auther $auther) {
        $userId = auth()->user()->id;
        if ($auther->user_is_following_auther) {
            $auther->users()->detach($userId);
        } else {
            $auther->users()->attach($userId);
        }
        return redirect('/updateProfile');
    }

    public function aquiringAuthers() {
        $genreHtml = new\Htmldom("https://www.goodreads.com/list/show/10762.Best_Book_Boyfriends");
        foreach ($genreHtml->find('table.tableList tr') as $row) {
            $bookUri = $row->children(2)->children(0)->href;
//                           code to get the books details from the goodreads
            $bookHtml = new \Htmldom("https://www.goodreads.com$bookUri");
            $autherUri = $bookHtml->find('a[class=authorName]', 0)->href;
            $splitedAutherId = explode('/', $autherUri);
            $autherId = explode('.', $splitedAutherId[5])[0];
            $goodreadsAutherIdCount = DB::table('authers')->where('goodreads_auther_id', $autherId)->count();

            if ($goodreadsAutherIdCount == 0) {
                $auther = new Auther;
                $autherHtml = new \Htmldom($autherUri);
//        code to get the authers details from goodreads
//  inserting the auther name to the DB
                $auther->name = $autherHtml->find('h1[class=authorName]', 0)->plaintext;

//  inserting the auther image to the DB 
                if ($autherHtml->find('div[class=leftContainer authorLeftContainer]', 0)->children(0)->src == "https://s.gr-assets.com/assets/nophoto/user/f_200x266-3061b784cc8e7f021c6430c9aba94587.png") {
                    $auther->image = $autherHtml->find('div[class=leftContainer authorLeftContainer]', 0)->children(0)->src;
                } else {
//                    $imgUrl = $autherHtml->find('div[class=leftContainer authorLeftContainer]', 0)->children(0)->href;
//                    $img = new \Htmldom("https://www.goodreads.com$imgUrl");
                    $auther->image = $autherHtml->find('div[class=leftContainer authorLeftContainer]', 0)->children(0)->children(0)->src;
                }
//  inserting the $autherDescription to the DB
                if ($autherHtml->find('div[class=aboutAuthorInfo]', 0)->children(3)) {
                    $auther->description = $autherHtml->find('div[class=aboutAuthorInfo]', 0)->children(3)->plaintext;
                } else {
                    $auther->description = $autherHtml->find('div[class=aboutAuthorInfo]', 0)->children(2)->plaintext;
                }
//  inserting goodreads_auther_id to DB
                $auther->goodreads_auther_id = $autherId;
                $auther->save();
            }
        }
    }

}
