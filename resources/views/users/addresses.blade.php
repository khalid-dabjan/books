@extends('layouts.app')
@section('content')
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<form method='POST'  action='/geoLocation'> 
    {{ csrf_field() }}
    <div class="class-form{{ $errors->has('name')?'has-error':'' }}">
        <input  name='name' value='' placeholder='Adress Name'>
        @if($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
    <input id='markerLat' name='lat' value='' type="hidden">
    <input id='markerLng' name='lng' value='' type='hidden'>
    <div>
        <button type='submit' class='submittingNewGeolocaion btn'> Submit you're address</button>
    </div>
</form>

<div id="map">
</div>


<?php
// put your code here
?>

<script>
    function initMap() {
        $.get('http://ipinfo.io', function (response) {
            var marker;
            var locParts = response.loc.split(',');
            var locObject = {lat: parseFloat(locParts[0]), lng: parseFloat(locParts[1])};
            var map = new google.maps.Map(document.getElementById('map'), {

                zoom: 8,
                center: locObject
            });
            marker = new google.maps.Marker({
                position: locObject,
                map: map
            });
            map.addListener("click", function (event) {
                marker.setMap(null);
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
            });
            marker.addListener('click', function () {
                map.setZoom(15);
                map.setCenter(marker.getPosition());
            });
            $('#map').ready(function () {
                $(".submittingNewGeolocaion").click(function () {
                    var currentLat = marker.getPosition().lat();
                    var currentLng = marker.getPosition().lng();
                    $('#markerLat').val(currentLat);
                    $('#markerLng').val(currentLng);
                });
            });
        }, "jsonp");
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_f4hYIGUlqVctOk1Qa7qeYRzqsONK1K0&callback=initMap" async defer>
</script>


@endsection

