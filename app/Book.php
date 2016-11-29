<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function auther() {
       return  $this->hasMany(Auther::class);
    }
}
