@extends('layouts.app')
@section('content')
<!-- //////////////////////// -->
<!--
<div class="inv-listing2-map margin-lg-t140">
    <div class="wpc-map" data-lat="40.7143528" data-lng="-74.0059731" data-zoom="10" data-style="style-1" data-string="WPC string"></div>
</div>
-->
<div style="height: 100px"></div>
<div class="container padd-lr0">
    <div class="row">
        <div class="col-xs-12">
            <div class="inv-listing-filter margin-lg-t5">
                <div class="inv-start-form">
                    <label for="key">
                        <input id="key" type="text" placeholder="Keywords">
                    </label>
                    <label for="loc">
                        <input id="loc" type="text" placeholder="All Locations">
                        <button class="get-geolocation-btn" type="button" name="button"><i class="fa fa-crosshairs"></i></button>
                    </label>
                    <label for="categ">
                        <select id="categ" class="selectpicker">
                            <option value="All">All Categories</option>
                            <option value="store">Store</option>
                            <option value="restaurant">Restaurant</option>
                            <option value="lodging">Hotels</option>
                            <option value="museum">Museum</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="inv-listing-slider">
                <div class="inv-radius">
                    <input type="checkbox" id="inv-checkbox">
                    <label for="inv-checkbox">Radius: <span id="len"></span></label>
                </div>
                <div class="inv-slider-wrap">
                    <div class="slider noUi-target noUi-ltr noUi-horizontal " id="slider1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg7">
    <div class="inv-listing-result inv-listing-result-js2 listpage">
        <div class="container padd-lr0">
            <div class="row">
                <div class="col-xs-12">
                    <header class="inv-listing-header">
                        <h6><span>97 </span>Results Found</h6>
                        <div class="inv-list-btn">
                            <a href="" class="fa fa-th-list " data-list="inv-listing-result-style2"></a>
                            <a href="" class="fa fa-th active" data-list="inv-listing-result-style1"></a>
                        </div>
                    </header>
                </div>
                <div class="col-xs-12">
                    <div class="inv-filter-item" data-value='10'>
                        @foreach($books as $book)
                        <div class="change-block-size col-lg-4 col-sm-6">
                            <div class="inv-places2-item">
                                <div class="inv-places2-head"><img src="{{ $book->cover }}" class="img-thumbnail" alt=""></div>
                                <div class="bg8 inv-list-style2 inv-places2-row">
                                    <div class="inv-places2-info">
                                        <h3>
                                            <a href="booksList/{{ $book->id }}/add">{{ $book->title }}</a>
                                        </h3>
                                        <span>by</span>
                                        <h3>
                                            @foreach($book->authers as $auther)
                                            <a href="/usersList/{{$auther->id}}/autherProfile">{{ $auther->name }}</a>
                                            @endforeach
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
</div>
    
@endsection