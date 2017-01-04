@extends('layouts.app')
@section('content')

<div class="table-responsive">
    <form enctype="multipart/form-data">
        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Book Cover</th>
                    <th>Published at</th>
                    <th>Book Description</th>
                    <th>Book ISPN</th>
                    <th>Book Rating</th>

                </tr>
            </thead>

            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>
                        <a href="booksList/{{ $book->id }}/add">{{ $book->title }}
                    </td>
                    <td>
                        <img src="{{ $book->cover }}" >
                    </td>
                    <td>
                        {{ date('m:d: y',strtotime($book->created_at)) }}
                    </td>
                    <td>
                        {{ $book->description }}
                    </td>

                    <td>
                        {{ $book->isbn }}
                    </td>
                    <td> 
                        {{$book->rating}}
                    </td>
                </tr>   
            </tbody>  
    </form>
    @endforeach
    @endsection