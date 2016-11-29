<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auther extends Model
{
    public function books() {
      return   $this->hasMany(Book::class);
    }
}
