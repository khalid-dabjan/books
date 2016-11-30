@extends('layouts.app')
@section('content')


<div class="table-responsive">
    <table class="table table-striped">

        <thead>
            <tr>
                <th>Address Name</th>
                <th>Adress Coordinates</th>
                <th>Address creation Date</th>
            </tr>
        </thead>

        <tbody>
        <a class='pull-right' href="{{ url('/updateProfile') }}"> Update You're Profile </a>

            @foreach($locations as $location)
            <tr>
                <td>
                    <a href="addresses/{{ $location->id }}/edit">{{ $location->name }}
                </td>
                <td>
                    { {{ $location->latitude }},{{ $location->longitude }} }
                </td>
                <td>
                    {{ date('m:d: y',strtotime($location->created_at)) }}
                </td>
                <td>
                    <div class="form-group pull-right">
                        <form role='form' method="POST" action="/updateProfile/addresses/{{ $location->id }}/delete">
                            {{ csrf_field()}} {{ method_field('DELETE') }}

                            <button class="btn btn-primary" type='submit'> DELETE ADDRESS </button>
                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
        @endforeach
        @endsection