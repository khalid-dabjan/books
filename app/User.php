<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_users')->withPivot('status');
    }

    public function booksWant()
    {
        return $this->belongsToMany(Book::class, 'books_users')->where('status', 'want')->withPivot('status');
    }

    public function booksHave()
    {
        return $this->belongsToMany(Book::class, 'books_users')->where('status', 'have')->withPivot('status');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers_users', 'followee_id', 'follower_id')->withPivot('type');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers_users', 'follower_id', 'followee_id')->withPivot('type');
    }

    public function getUserIsFollowingUserAttribute()
    {
        return (auth()->check()) ? in_array($this->id, auth()->user()->followings->pluck('id')->toArray()) : false;
    }

    public function authers()
    {
        return $this->belongstoMany(Auther::class, 'followers_users', 'follower_id', 'followee_id')->withPivot('type');
    }

    public function myNotify($instance)
    {
//        $isNotified = \Illuminate\Support\Facades\DB::table('notifications')->where('notifiable_id', $this->id)
//                        ->where('data->type', $instance->type)
//                        ->where('data->matche_user_id')
//                        ->where('data->book_id')->count();
//        dd($isNotified);
        $this->notify($instance);
    }

}