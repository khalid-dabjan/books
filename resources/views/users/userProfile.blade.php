@extends('layouts.app')
@section('content')





<div style="height:100px;"></div>  

<div class="col-xs-12">
    <div class="change-block-size col-lg-4 col-sm-6">
        <div class="inv-places2-item">
            <div class="inv-places2-info bg6">
                <h3 class="h3 offset-2">
                    {{ $user->name }}
                </h3>
            </div>
            <div class="bg8 inv-list-style2 inv-places2-row">
                <div class="inv-places2-info">
                    <ul>
                        <li >
                            User Provider : {{ $user->registered_from }}
                        </li>
                        <li>
                            Registered At : {{ $user->created_at }}
                        </li>
                        <li>
                            <form method="POST" action="/usersList/{{ $user->id }}/follow" class="fillter-wrap">
                                {{csrf_field()}}
                                <button type="submit" class="button activbut bg6">
                                    {{ $user->user_is_following_user?'Unfollow User':'Follow User' }} 
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="height:100px;"></div>  
<div class="container padd-lr0">
    <div class="row margin-lg-t155">

    </div>
</div>

<div class="bg7">
    <div class="inv-listing-result inv-listing-result-js2 listpage">
        <div class="container padd-lr0">
            <div class="row">
                <div class="col-xs-12">
                    <header class="inv-listing-header">
                        <h3 class='h2'><span>{{$user->name}}</span> following </h3>
                        <div class="inv-list-btn">
                            <a href="" class="fa fa-th-list " data-list="inv-listing-result-style2"></a>
                            <a href="" class="fa fa-th active" data-list="inv-listing-result-style1"></a>
                        </div>
                    </header>
                </div>
                <div class="col-xs-12">
                    @foreach($user->authers as $auther)                    
                    <div class="change-block-size col-lg-4 col-sm-6">
                        <div class="inv-places2-item">
                            <div class="inv-places2-head"><img src="{{ $auther->image }}"  alt=""></div>
                            <div class="bg8 inv-list-style2 inv-places2-row">
                                <div class="inv-places2-info">
                                    <h3>
                                        <a href="/usersList/{{$auther->id}}/autherProfile">{{ $auther->name }}</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container padd-lr0">
    <div class="row margin-lg-t155">
        <div class="col-xs-12">
        </div>
    </div>
</div>
<div class="bg7">
    <div class="inv-listing-result inv-listing-result-js2 listpage">
        <div class="container padd-lr0">
            <div class="row">
                <div class="col-xs-12">
                    <header class="inv-listing-header">
                        <h4 class='h4'><span>{{$user->name}} </span>Books</h4>
                        <div class="inv-list-btn">
                            <a href="" class="fa fa-th-list " data-list="inv-listing-result-style2"></a>
                            <a href="" class="fa fa-th active" data-list="inv-listing-result-style1"></a>
                        </div>
                    </header>
                </div>
                <div class="col-xs-12">
                    <div class="inv-filter-item" data-value='10'>
                        @foreach($user->books as $book)
                        <div class="change-block-size col-lg-4 col-sm-6">
                            <div class="inv-places2-item">
                                <div class="inv-places2-head"><img src="{{ $book->cover }}" class="img-thumbnail" alt=""></div>
                                <div class="bg8 inv-list-style2 inv-places2-row">
                                    <div class="inv-places2-info">
                                        <ul>
                                            <li>
                                                <h3>
                                                    <a href="/booksList/{{ $book->id }}/add">{{ $book->title }}</a>
                                                </h3>
                                                <span>by</span>
                                                <h3>
                                                    @foreach($book->authers as $auther)
                                                    <a href="/usersList/{{$auther->id}}/autherProfile">{{ $auther->name }}</a>
                                                    @endforeach
                                                </h3>
                                            </li>
                                            <li>
                                                <h4 class='h4'>{{$user->name}} {{$book->pivot->status}} This Book</h4>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(.markedRead).onclick(function () {
        $.ajax({
            url: '/markRead',
            type: 'post',

        });
    });

</script>

@endsection
