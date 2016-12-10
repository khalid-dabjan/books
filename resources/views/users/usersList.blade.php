@extends('layouts.app')
@section('content')

<a class="pull-right" href= "{{ url('/home') }}" >Home</a>
<form>    
    <div class="table-responsive">
        <table class="table table-striped"> 

            <thead> 
                <tr>
                    <th>User Name</th>
                    <th>User Provider</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <a href='/usersList/{{$user->id}}/userProfile'>{{ $user->name }}</a>
                    </td>
                     <td>
                        {{ $user->registered_from }}
                    </td>
                    <td>
                        {{ $user->created_at }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>

<form>    
    <div class="table-responsive">
        <table class="table table-striped"> 

            <thead> 
                <tr>
                    <th>Auther Name</th>
                    <th>Auther Description</th>
                    <th>Auther Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authers as $auther)
                <tr>
                    <td>
                        <a href='/usersList/{{$auther->id}}/autherProfile'>{{ $auther->name }}</a>
                    </td>
                     <td>
                        {{ $auther->description }}
                    </td>
                    <td>
                        {{ $auther->image }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>


@endsection



