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
    
    public function locations() {
        return $this->hasMany(Location::class);
    }
    
    public function books() {
        return $this->belongsToMany(Book::class,'books_users');
    }
    
    public function users() {
        return $this->belongsToMany(User::class,('followers_users'));
    }
}
