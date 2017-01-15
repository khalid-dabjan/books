<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no" />

        <meta name="author" content="">
        <meta name="description" content="Task">
        <meta name="keywords" content="">
        <title>{{ config('app.name', 'Books') }}</title>
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <!-- bootstrap -->
        <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/jquery.datetimepicker.min.css') }}">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="{{ url('/css/bootstrap-select.min.css') }}">
        <!-- popup -->
        <link rel="stylesheet" type="text/css" href="{{ url('/css/magnific-popup.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/nouislider.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/index.css') }}">
        <!--[if lt IE 9]>
          <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="inv-header ">
            <div class="container">
                <div class="wpc-navigation clearfix">
                    <div class="col-xs-12 padd-lr0">
                        <nav>
                            <ul class="main-menu">
                                <li class="menu-item menu-item-has-children active-menu-item">
                                    <a href="#">Menu</a>
                                    <ul class="sub-menu">
                                        <li class="menu-item active-menu-item">
                                            <a href="{{ url('/home') }}"> Home </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/usersList') }}" >Users</a>
                                        </li>   
                                        <li>
                                            <a href="{{ url('/booksList') }}">Books</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children active-menu-item">
                                    <a href="#">You</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="{{ url('/updateProfile') }}"> You're Profile </a>
                                        </li>
                                        <li class="menu-item ">
                                            <a href="{{ url('/updateProfile/addresses') }}">Add New Address </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children active-menu-item ">
                                    <a href="#">Notifications</a>
                                    @foreach((auth()->user())->unreadNotifications as $notification)
                                    
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="/usersList/{{ $notification->data['matche_user_id'] }}/userProfile" class="markedRead">Match Found with You and : {{ App\User::find($notification->data['matche_user_id'])->name}}</a>
                                        </li>
                                        <li>
                                            <a href="booksList/{{ App\Book::find($notification->data['book_id']) }}/add">For the Book : {{ App\Book::find($notification->data['book_id']) }}</a>
                                        </li>
                                        <li> <a>at : {{ App\Location::find($notification->data['have_location_id'])->name }}</a>
                                        </li>

                                    </ul>
                                    @endforeach
                                </li>
                                <li class="menu-item menu-item-has-children active-menu-item">
                                    <a href="#">{{Auth::check()?'Logout':'Sign' }}</a>
                                    @if(Auth::check())
                                    <ul class="sub-menu">
                                        <li class="menu-item ">
                                            <a class="popup-form" href="{{url('/logout')}}"
                                               onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                    </ul>
                                    @else
                                    <ul class="sub-menu">
                                        <li class="menu-item "><a class="popup-form" href="{{ url('/login') }}">Login</a></li>
                                        <li class="menu-item "><a class="popup-form" href="{{ url('/register') }}">Register</a></li>
                                    </ul>
                                    @endif

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>



        @yield('content')

        <!-- FOOTER -->

        <footer class="inv-bg-block padding-lg-t115 padding-lg-b105 padding-xs-t0 padding-xs-b50">
            <img src="images/world-map.jpg" alt="" class="inv-img">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 padd-lr0">
                        <div class="inv-address">

                            <p>For any questions or suggestions please contact me on this info</p>
                            <ul>
                                <li><a href=""><i class="fa fa-phone"></i> +20 101 3291 286</a></li>
                                <li><a href=""><i class="fa fa-envelope"></i>Ragheed.aidi@gmail.com.com</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="inv-copy bg-12">
            <div class="container padd-lr0">
                <div class="row">
                    <div class="col-xs-12">

                    </div>
                </div>
            </div>
        </div>



        <!-- Scripts project -->
        <script type="text/javascript" src="{{ url('/js/jquery-2.2.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/js/bootstrap.min.js') }}"></script>
        <!-- count -->
        <script type="text/javascript" src="{{ url('/js/jquery.countTo.js') }}"></script>
        <!-- google maps -->
        <!-- swiper -->
        <script type="text/javascript" src="{{ url('/js/idangerous.swiper.min.js') }}"></script>
        <!-- jQuery Responsive Thumbnail Gallery Plugin -->
        <script type="text/javascript" src="{{ url('/js/responsivethumbnailgallery.js') }}"></script>
        <script type="text/javascript" src="{{ url('/js/jquery.datetimepicker.full.min.js') }}"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script type="text/javascript" src="{{ url('public/js/bootstrap-select.min.js') }}"></script>
        <!-- popup -->
        <!-- rating -->
        <script type="text/javascript" src="{{ url('/js/jquery.raty-fa.js') }}"></script>
        <!-- izotop -->
        <script type="text/javascript" src="{{ url('/js/isotope.pkgd.min.js') }}"></script>
        <!-- slider -->
        <script type="text/javascript" src="{{ url('/js/nouislider.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/js/jquery.matchHeight.js') }}"></script>
        <script type="text/javascript" src="{{ url('/js/index.js') }}"></script>
        <!-- sixth block end -->
        <script type="text/javascript">
            $('.markedRead').click(function () {
                $.ajax({
                    url: '/markRead',
                    type: 'post'

                });
            });

        </script>
    </body>

</html>
