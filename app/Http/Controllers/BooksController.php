<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller {
    
    public function __construct() {
         $this->middleware('auth')->only(['addBook','deleteBook']);
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
        if ($book->users()) {
            $book->users()->detach();
        } else {
            abort(404);
        }
        return redirect('/home');
    }

    

}
