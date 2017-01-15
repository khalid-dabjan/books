@extends('layouts.entry')
@section('content')
<!-- //////////////////////// -->
<div class="inv-start-block inv-bg-block"><img src="images/bg1.jpg" alt="" class="inv-img">
    <div class="container padd-lr0">
        <div class="row">
            <div class="col-xs-12">
                <header class=" inv-block-header margin-lg-t340 margin-lg-b75 margin-sm-t270">
                    <h1>Explore your City’s Finest</h1>
                    <h5>We help you to find hotels, restaurents, shops, places to visit, etc in over 150+ Countries</h5>
                </header>
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
                    <div class="radius">
                        <a class="compas  icon-compass icons"></a>
                        <div class="radius__popup">
                            <button class="radius__close"><i class="fa fa-times"></i></button>
                            <span class="radius__output"><span class="js-radius">50</span>km</span>
                            <input type="range" name="rad" class="radius__bar" value="50" min="0.1" step="0.1" max="100">
                            <span class="radius__help">Set radius for geolocation</span>
                        </div>
                    </div>
                    <button id="searchList"><i class="icon-magnifier icons"></i>Search Now</button>
                </div>
                <div class="inv-group margin-lg-b200 margin-sm-b100">
                    <a href="{{ url('/usersList') }}" class="inv-group-item bg19"><i class="fa fa-male"></i><span>Users</span></a>
                    <a href="{{ url('/updateProfile') }}" class="inv-group-item bg2"><i class="fa fa-user"></i><span>Update You're Profile </span></a>
                    <a href="{{ url('/booksList') }}" class="inv-group-item bg20"><i class="fa fa-book"></i><span>Books</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

                @endsection