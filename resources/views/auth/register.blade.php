@extends('layouts.entry')

@section('content')
<form class="inv-blog-post-form center-block" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}

    <div class="inv-blog-post-form{{ $errors->has('name') ? ' has-error' : '' }}">
        <input placeholder="User Name" type="text"  name="name" value="{{ old('name') }}" required autofocus>

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>

    <div class="inv-blog-post-form{{ $errors->has('email') ? ' has-error' : '' }}">

        <input id="email" type="email"  name="email" placeholder="Email Address" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>

    <div class="inv-blog-post-form{{ $errors->has('password') ? ' has-error' : '' }}">

        <input  type="password" name="password" placeholder="Password" required>

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="inv-blog-post-form ">

        <input placeholder="Password Confirm" type="password"  name="password_confirmation" required>
    </div>
    <div class="inv-blog-post-form ">

        <button type="submit" >
            Register
        </button>
    </div>
    
    
</form>



@endsection
