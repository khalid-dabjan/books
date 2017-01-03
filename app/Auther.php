<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auther extends Model
{
    
    public function books() {
      return   $this->belongsToMany('App\Book');
    }
    public function users() {
       return $this->belongsToMany('App\User','followers_users','followee_id','follower_id')->withPivot('type');
    }
    
    public function getUserIsFollowingAutherAttribute() {
        return  (auth()->check())?in_array($this->id,auth()->user()->authers->pluck('id')->toArray()):false;
    }
}
