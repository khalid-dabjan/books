@extends('layouts.app')
@section('content')

<div class='container-fluid'>
    <form method='POST' action= '/usersList/{{ $auther->id }}/autherFollowing'>
        {{ csrf_field() }}
        <div class='form-group'>
            {{  $auther->name }}
        </div>
        <div class='form-group'>
            {{  $auther->image }}

        </div>
        <div class='form-group'>
            {{  $auther->description }}
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-primary">
               {{ $auther->user_is_following_auther ? 'Unfollow Auther' :'Follow Auther' }}
            </button>
        </div>
    </form>
</div>



@endsection