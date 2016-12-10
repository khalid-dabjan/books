<?php

namespace App\Http\Controllers;

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

    public function comparingCoordinates(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
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

    public function comparingBooks() {
        $users = User::get();
        foreach ($users as $user) {
            $wantBooks = $user->books()->where('status', 'want')->get();
            $userWantLat = $user->locations->pluck('latitude');
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

        if ($distance > 10) {
//                                        notify the user who wants the Book 
            $user->notify(new BookMatch);
//                                        notify the user who have the Book 
            $userHaveBook->notify(new BookMatch);
        }
    }

}
