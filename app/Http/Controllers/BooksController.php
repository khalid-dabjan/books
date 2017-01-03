<?php

namespace App\Http\Controllers;

use App\Auther;
use App\User;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\BookMatch;

class BooksController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only(['addBook', 'deleteBook']);
    }

    public function getBooksList() {
        $books = Book::get();
        return view('books.booksList', compact('books'));
    }

    public function getBook(Book $book) {
        return view('books.addBook', compact('book'));
    }

    public function addBook(Request $request, Book $book) {
        $user = auth()->user();
        $user->books()->attach($book->id, ['status' => $request->get('status')]);
        return redirect('/home');
    }

    public function deleteBook(Book $book) {
        $user = auth()->user();
        if ($user->books()) {
            $user->books()->detach($book->id);
        } else {
            abort(404);
        }
        return redirect('/home');
    }

    public function markNotificationRead(User $user) {
        $user->unreadNotifications()->markAsRead();
    }

    public static function booksUrlExtractor($uri) {
        $html = new \Htmldom($uri);
        $ul = $html->find('ul[class=tagList greyText]', 0);
        foreach ($ul->find('li') as $li) {
            $tagUri = $li->children(0)->href;
            $tagHtml = new \Htmldom("https://www.goodreads.com$tagUri");
            foreach ($tagHtml->find('div[class=listImgs]') as $listImgs) {
                $genreUri = $listImgs->children(0)->href;
                $genreHtml = new\Htmldom("https://www.goodreads.com$genreUri");
                foreach ($genreHtml->find('table.tableList tr') as $row) {
                    $bookUri = $row->children(2)->children(0)->href;
                    //                  code to get the books details from the goodreads
                    $bookHtml = new \Htmldom("https://www.goodreads.com$bookUri");
                }
            }
        }
    }

    public function aquiringBooks() { // this method to save the data from goodreads to the database for both book/authers 
        $genreHtml = new\Htmldom("https://www.goodreads.com/list/show/10762.Best_Book_Boyfriends");
        foreach ($genreHtml->find('table.tableList tr') as $row) {
            $bookUri = $row->children(2)->children(0)->href;
            //                  code to get the books details from the goodreads
            $bookHtml = new \Htmldom("https://www.goodreads.com$bookUri");

            $isbnCount = DB::table('books')->where('isbn', $bookHtml->find('div[id=bookDataBox]', 0)->children(1)->children(1)->plaintext)->count();
            if ($isbnCount == 0) {
                $book = new Book;
                $autherUri = $bookHtml->find('a[class=authorName]', 0)->href;
                $splitedAutherId = explode('/', $autherUri);
                $goodreadsAutherId = explode('.', $splitedAutherId[5])[0];
                $autherId = DB::table('authers')->where('goodreads_auther_id', $goodreadsAutherId)->value('id');

//  inserting book title to DB 
                $book->title = $bookHtml->find('h1[id=bookTitle]', 0)->plaintext;
//  inserting   book cover
                $book->cover = $bookHtml->find('img[id=coverImage]', 0)->src;
//  inserting the description to DB
                if ($bookHtml->find('div[id=description]', 0)->children(1)) {
                    $book->description = $bookHtml->find('div[id=description]', 0)->children(1)->plaintext;
                } else {
                    $book->description = $bookHtml->find('div[id=description]', 0)->children(0)->plaintext;
                }
//  inserting the rating to DB 
                $book->rating = $bookHtml->find('span[class=average]', 0)->plaintext;
//  inserting the isbn to DB

                $book->isbn = $bookHtml->find('div[id=bookDataBox]', 0)->children(1)->children(1)->plaintext;

                if (strlen($book->isbn) > 13) {
                    $book->isbn = explode(')', explode(':', $book->isbn)[1])[0];
                }

                $book->save();
                if (DB::table('auther_book')->where('auther_id', $autherId)->where('book_id', $book->id)->count() == 0) {
                    $book->authers()->attach($autherId);
                }
                    foreach ($bookHtml->find('a[class=actionLinkLite bookPageGenreLink]') as $bookGenre) {
                        $genreId = DB::table('genres')->where("name", $bookGenre->plaintext)->value('id');
                if(DB::table('book_genre')->where('book_id', $book->id)->where('genre_id', $genreId)->count() == 0) {
                        $book->genres()->attach($genreId);
                    }
                }
            }
        }
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
                    $imgUrl = $autherHtml->find('div[class=leftContainer authorLeftContainer]', 0)->children(0)->href;
                    $img = new \Htmldom("https://www.goodreads.com$imgUrl");
                    $auther->image = $img->find('img', 0)->src;
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

    public function comparingBooks() {
        $users = User::get();
        foreach ($users as $wantUser) {
            $wantBooks = $wantUser->books()->where('status', 'want')->get();
            foreach ($wantBooks as $wantBook) {
                $haveUsers = User::whereHas('booksHave', function($q) use ($wantBook) {
                            $q->where('books.id', $wantBook->id);
                        })->get();
//                dd($haveUsers->first()->notifications);
                foreach ($haveUsers as $haveUser) {
                    foreach ($wantUser->locations as $wantUserLocation) {
                        foreach ($haveUser->locations as $haveUserLocation) {
                            $distance = Book::comparingCoordinates((float) $haveUserLocation->latitude, (float) $haveUserLocation->longitude
                                            , (float) $wantUserLocation->latitude, (float) $wantUserLocation->longitude) / 1000;
                            if ($distance > 10) {//KM
//                                dd($distance);
//                                        notify the user who wants the Book 
                                $wantUser->myNotify(new BookMatch('want_user_match', $haveUser->id, $wantBook->id, $haveUserLocation->id, $wantUserLocation->id));
                                $haveUser->myNotify(new BookMatch('have_user_match', $wantUser->id, $wantBook->id, $haveUserLocation->id, $wantUserLocation->id));
//                                        notify the user who have the Book 
//                                $userHaveBook->notify(new BookMatch);
                            }
                        }
                    }
                }
            }
            die;





            $userWantLat = $user->locations->pluck('latitude');
            foreach ($user->locations as $location) {
                dd($location);
            }










            dd($userWantLat);
            foreach ($userWantLat as $latWant) {
                $floatLatWant = (float) $latWant;
                $userWantLng = $user->locations->pluck('longitude');
                foreach ($userWantLng as $lngWant) {
                    $floatLngWant = (float) $lngWant;
                    foreach ($wantBooks as $book) {
                        $haveBook = DB::table('books_users')->where('book_id', $book->id)->where('status', 'have')->get();
                        foreach ($haveBook as $oneBookHave) {
                            $haveBookUserId = $oneBookHave->user_id;
                            $userHaveBook = User::find($haveBookUserId);
//                      each  Location from locaions for the user who *have* the book needed .
                            foreach ($userHaveBook->locations as $latHave) {
                                $floatLatHave = (float) $latHave->latitude;
                                foreach ($userHaveBook->locations as $lngHave) {
                                    $floatLngHave = (float) $lngHave->longitude;
                                }
                            }
                        }
                    }
                }
            }
        }

        $distance = BooksController::comparingCoordinates($floatLatWant, $floatLngWant, $floatLatHave, $floatLngHave) / 1000;

        if ($distance < 10) {
//                                        notify the user who wants the Book 
            $user->notify(new BookMatch);
//                                        notify the user who have the Book 
            $userHaveBook->notify(new BookMatch);
        }
    }

}
