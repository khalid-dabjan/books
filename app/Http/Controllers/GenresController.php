<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GenresController extends Controller {

    public function getGenres() {
        $html = new \Htmldom('https://www.goodreads.com/genres/list?page=3');
        foreach ($html->find('div[class=shelfStat]') as $element) {
            $genre = new Genre;
            $genre->name = $element->children(0)->children(0)->plaintext;

            if (DB::table('genres')->where('name', $genre->name)->count() == 0) {
                $genre->save();
            }
        }
    }
    
    

}
