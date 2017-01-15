@extends('layouts.app')
@section('content')
<!-- //////////////////////// -->
<!-- //////////////////////// -->
<!-- //////////////////////// -->

<div class="inv-blog-wrap bg7 add-padd-xs padding-lg-t150  marg-sm-t50">
    <div class="container  ">
        <div class="row">
            <div class="col-md-8 padd-lr0">

                <article class="inv-stories-item inv-stories-item5 inv-stories-post margin-lg-b60 ">
                    <div class="inv-stories-content">
                        <div class='col-xs-8 col-md-6'><img src="{{ $book->cover }}" alt="" class="inv-img">
                            <ul>    
                                <li>
                                    ISBN:{{ $book->isbn }}
                                </li>
                                <li>
                                    Book Rating:{{ $book->rating }} 
                                </li>
                            </ul>
                        </div>
                        <div class='h4' ><h4>{{ $book->title }}</h4> </div>
                        <div class="col-xs-8 col-md-6 inv-stories-info h5">
                            @foreach($book->authers as $auther)
                            <a href="/usersList/{{$auther->id}}/autherProfile">Created By:{{ $auther->name }}</a>
                            @endforeach

                        </div>
                        <div class="col-md-6 inv-stories-info p">

                            <p>{{ $book->description }}</p>
                        </div>
                        <div class="col-md-4" >
                            <form class="inv-start-form inv-stories-footer " method='POST' 
                                  action= '{{ $book->user_has_it?"/booksList/$book->id/delete":"/booksList/$book->id/add " }}' enctype="multipart/form-data"> 
                                {{ csrf_field() }} {{ $book->user_has_it?method_field("DELETE"):'' }}

                                @if($book->user_has_it)
                                <button name='status' value='have' class='bootstrap-select button' type='submit'>Delete from list</button>
                                @else
                                <button name='status' value='want' class='bootstrap-select button' type='submit'>I need this book</button>                            </button>
                                <button name='status' value='have' class='bootstrap-select button' type='submit'>I got this book</button>                            </button>
                                @endif 
                            </form>
                        </div> 
                        <div class="soc-net">
                            <ul>
                                <li>
                                    <a href="" class='fa fa-twitter bg20'></a>
                                </li>
                                <li>
                                    <a href="" class='fa fa-facebook bg17'></a>
                                </li>
                                <li>
                                    <a href="" class='fa fa-google-plus bg18'></a>
                                </li>
                                <li>
                                    <a href="" class='fa fa-share-alt'></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-md-4 padd-lr0">
                <aside class="inv-widgets">
                    <div class="inv-widget-search">
                        <div class="form">
                            <input type="text" placeholder="Search ..">
                            <button><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div style='height: 50px;'></div>
                    <section class="inv-tags">
                        <header>
                            <h5>Genres Cloud</h5>
                        </header>
                        @foreach($book->genres as $genre)
                        <a class="inv-tag bg-12"> {{ $genre->name }}  </a>
                        @endforeach

                    </section>
                </aside>
            </div>
        </div>
    </div>
</div>


@endsection