@extends('layouts.app')
@section('content')
<div class="container">
    <form method='POST' 
        action= '{{ $book->user_has_it?"/booksList/$book->id/delete":"/booksList/$book->id/add " }}' enctype="multipart/form-data"  >
           {{ csrf_field() }} {{ $book->user_has_it?method_field("DELETE"):'' }}
        <div>
            <select name='status' class="input-sm">   
                <option value='have'>I have this Book </option>

                <option value='want'>I want this Book </option>

            </select>
        </div>
        Book Title:
        <div class='form-group'>       
            {{ $book->title }}
        </div>
        Book Description:
        <div class='form-group'>       
            {{ $book->description }}
        </div>
        Book Cover:
        <div class='form-group'>       
            {{ $book->cover }}
        </div>
        Book ISBN:
        <div class='form-group'>       

            {{ $book->isbn }}
        </div>
        Book Rating:
        <div class='form-group'>       

            {{ $book->rating }} 
        </div>
        <div>
            <button class='btn' type='submit' > "{{ $book->user_has_it?'Delete From List':'Add to list' }}"</button>
        </div>
    </form>
    
</div>

@endsection