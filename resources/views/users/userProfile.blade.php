@extends('layouts.app')
@section('content')



<ul>
    <li class='dropdown'>
        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button'>
            Notifications
        </a>
        @foreach($user->unreadNotifications as $notification)

        <ul class="dropdown-menu">

            <li class="markedRead"><a href='/usersList/{{ $notification->data["matche_user_id"] }}/userProfile'>Match Found with You and:{{ App\User::find($notification->data['matche_user_id'])->name}}</a></li>
            <li>For the Book::find{{ App\Book::find($notification->data['book_id'])->title }}</li>
            <li>at:{{ App\Location::find($notification->data['have_location_id'])->name }}</li>

        </ul>
        @endforeach
    </li>
</ul>
<div class="container" >
    <form method="POST" action="/usersList/{{ $user->id }}/follow">
        {{csrf_field()}}
        <div>
            <table class="table table-striped">
                <thead> 
                    <tr>
                        <th>User Name</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td>
                            {{$user->name }}
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                {{ $user->user_is_following_user?'Unfollow User':'Follow User' }} 
                            </button>
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
<script type="text/javascript">
    $(.markedRead).onclick(function(){
        $.ajax({
            url:'/markRead',
            type:'post',
            
        });
    });

</script>

@endsection
