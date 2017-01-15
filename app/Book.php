<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    public function authers() {
        return $this->belongsToMany(Auther::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'books_users')->withPivot('status');
    }

    public function getUserHasItAttribute() {

        return (auth()->check()) ? in_array($this->id, auth()->user()->books->pluck('id')->toArray()) : false;
    }

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }

    public static function comparingCoordinates($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

}
