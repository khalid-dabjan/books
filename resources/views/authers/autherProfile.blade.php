@extends('layouts.app')
@section('content')

<div class="inv-blog-wrap bg7 add-padd-xs padding-lg-t115  marg-sm-t50">
    <div class="container  ">
        <div class="row">
            <div class="col-md-7 padd-lr0">
                <article class="inv-stories-item inv-stories-item5 inv-stories-post margin-lg-b60 ">
                    <div class="inv-stories-content">
                        <div class='col-md-5'><img src="{{ $auther->image }}"  class="inv-categorys2 inv-category-item inv-category-head"  alt=''></div>
                        <div class="col-md-7 inv-stories-info p">
                            <h2 class='h2'>{{ $auther->name }}</h2>
                            <p>{{ $auther->description }}</p>
                        </div>

                        <div class="inv-footer-item ">
                            <form  class="inv-start-form " method='POST' 
                                   action= '/usersList/{{ $auther->id }}/autherFollowing' enctype="multipart/form-data"> 
                                {{ csrf_field() }} 

                                <button>
                                    {{ $auther->user_is_following_auther ? 'Unfollow Auther' :'Follow Auther' }}
                                </button>

                            </form>
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
            <div class="col-md-5 padd-lr0">
                <aside class="inv-widgets">
                    <section class="inv-widget-posts">
                        <section class="inv-tags">
                            <header>
                                <h5>Auther Books</h5>
                            </header>
                            <article class="inv-stories-item inv-stories-item5 inv-stories-post margin-lg-b60 ">
                                <div class="inv-stories-item">
                                    @foreach($auther->books as $book)
                                    <ul>
                                        <li>
                                            <a href="/booksList/{{ $book->id }}/add">
                                                <img src="{{ $book->cover }}" alt="" class='inv-listing-img'>{{$book->title}}
                                            </a>
                                        </li>
                                    </ul>

                                    @endforeach
                                </div>
                            </article>
                        </section>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</div>


@endsection