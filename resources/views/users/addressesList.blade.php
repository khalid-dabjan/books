@extends('layouts.app')
@section('content')
<div style='height:100px;width:100%'></div>

<div class="container col-md-14 center-block">
    <table class="bg13 table-hover">
        <thead>
            <tr>
                <th class="col-xs-4 h3 bg14 ">Address Name</th>
                <th class="col-xs-3 h3 bg14 ">Adress Coordinates</th>
                <th class="col-xs-3 h3 bg14 ">Address creation Date</th>
            </tr>
        </thead>

        <tbody>

            @foreach($locations as $location)
            <tr>
                <td>
                    <div class='inv-poput-link col-md-6'>
                        <a href="addresses/{{ $location->id }}/edit" class="fa fa-map bg12">{{ $location->name }}
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="inv-listing2-map margin-lg-t140 margin-sm-t95">
                        {{ round($location->latitude,2) }}:{{ round($location->longitude,2) }}
                    </div>

                </td>
                <td class="col-xs-3">
                    {{ date('m:d: y',strtotime($location->created_at)) }}
                </td>
                <td>
                    <div class="fillter-wrap">
                        <form role='form' method="POST" action="/updateProfile/addresses/{{ $location->id }}/delete">
                            {{ csrf_field()}} {{ method_field('DELETE') }}

                            <button class="button activbut bg10" type='submit'> DELETE ADDRESS </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="inv-poput-link col-sm-6 center-block">
        <a href="{{ url('/updateProfile/addresses') }}" class="fa-map-marker bg12">Add Address</a>

    </div>
</div>





<script>
    for (in)
            function initMap() {
<?php foreach ($locations as $location) : ?>
                    var locObject = {lat: <?php echo $location->latitude; ?>, lng: <?php echo $location->longitude; ?>};
<?php endforeach; ?>
                var map = new google.maps.Map(document.getElementById('wasab'), {
                    zoom: 8,
                    center: locObject
                });
                marker = new google.maps.Marker({
                    position: locObject,
                    map: map
                });

            }
</script>

<script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyC_f4hYIGUlqVctOk1Qa7qeYRzqsONK1K0&callback=initMap" async defer ></script>

@endsection