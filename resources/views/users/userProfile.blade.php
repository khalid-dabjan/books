@extends('layouts.app')
@section('content')
<div class="container" >
    <form method="POST" action="usersLis/{{$user->id}}/follow">
        {{csrf_field}}
        <div>
        {{$user->name }}
        </div>
        <button type="submit" class="btn btn-primary">
            Follow User
        </button>
    </form>
</div>
@endsection
