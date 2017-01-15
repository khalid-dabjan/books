@extends('layouts.entry')

@section('content')
<div class="inv-blog-post-form container" >
    <form  role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="inv-blog-post-form input{{ $errors->has('email') ? ' has-error' : '' }}">

            <input  id="email" type="email" class="inv-blog-post-form input" name="email" placeholder='Email Address' value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="inv-blog-post-form input{{ $errors->has('password') ? ' has-error' : '' }}">

            <input id="password" type="password" class="inv-blog-post-form input" placeholder='Password' name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class='input-group-btn'>
            <button type="submit" class="group-button" >
                Login
            </button>
        </div>


    </form>
    <div class="inv-poput-link">
        <a href="{{ url('/password/reset') }}" class="fa-adjust bg10">Forgot Your Password?</a>
        <span>or</span>
        <a href="{{ url('/facebook') }}" class="fa fa-facebook bg18">Sign in With Facebook</a>
        <a href="{{ url('/google') }}" class="fa fa-google bg17">Sign in With Google</a>
        <a href="{{ url('/twitter') }}" class="fa fa-twitter bg20">Sign in With twitter</a>
    </div>
</div>



@endsection
