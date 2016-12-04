<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    
    

    public function auther() {
        return $this->hasMany(Auther::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'books_users');
    }

    public function getUserHasItAttribute() {

        return (auth()->check()) ? in_array($this->id, auth()->user()->books->pluck('id')->toArray()) : false;
    }

}
