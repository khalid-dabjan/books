@extends('layouts.app')
@section('content')


<div class="container" >
    <form method="POST" action="/usersList/{{ $user->id }}/follow">
        {{csrf_field()}}
        <div>
            <table class="table table-striped">
                <thead> 
                    <tr>
                        <th>User Name</th>
                        <th>status</th>
                        <th>auther/user</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td>
                            {{$user->name }}
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                            {{ $user->user_is_following?'Unfollow User':'Follow User' }} 
                            </button>
                        </td>
                        <td>
                            <select name="type">
                                <option value="auther">auther</option>
                                <option value="user">user</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>
<form>
    {{csrf_field()}}
    <div>
        <table class="table table-striped">
            <thead> 
                <tr>
                    <th>User Name</th>
                    <th>Following</th>
                    <th>Followers</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>
                        {{$user->name }}
                    </td>
                    <td>
                        @foreach($user->followings->pluck('name') as $name)
                        <ul>
                            <li>{{ $name }}</li>
                        </ul>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

<form>  
    <div class="table-responsive">
        <table class="table table-striped"> 

            <thead> 
                <tr>
                    <th>Book Title</th>
                    <th>Book Cover</th>
                    <th>Published at</th>
                    <th>Book Description</th>
                    <th>Book ISPN</th>
                    <th>Book Rating</th>
                    <th>Book status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->books as $book)
                <tr>
                    <td>
                        <a href="booksList/{{ $book->id }}/add">{{ $book->title }}
                    </td>
                    <td>
                        {{ $book->cover }}
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
                    <td>
                        {{$book->pivot->status}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>

@endsection
