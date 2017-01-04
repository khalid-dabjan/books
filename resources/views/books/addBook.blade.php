@extends('layouts.app')
@section('content')
<div class="container ">
    <form method='POST' 
          action= '{{ $book->user_has_it?"/booksList/$book->id/delete":"/booksList/$book->id/add " }}' enctype="multipart/form-data"  >
        {{ csrf_field() }} {{ $book->user_has_it?method_field("DELETE"):'' }}
        <div class ="pull-right">
            <select name='status' class="input-sm">   
                <option value='have'>I have this Book </option>

                <option value='want'>I want this Book </option>

            </select>
        </div>
        Title:{{ $book->title }}
        <div class='form-group'>       
            <img src="{{ $book->cover }}" >


            {{ $book->description }}
        </div>
        <ul>
            <li>
                ISBN:{{ $book->isbn }}
            </li>
            <li>
                Book Rating:{{ $book->rating }} 
            </li>
        </ul>
        <div>
            <button class='btn' type='submit' > "{{ $book->user_has_it?'Delete From List':'Add to list' }}"</button>
        </div>
    </form>

</div>

@endsection