@extends('layouts.app')
@section('content')
<div class="inv-listing2-map margin-lg-t140 margin-sm-t95">
    <div id="map" class='wpc-map' ></div>
</div>
<div class="container padd-lr0" >
    <div class="row">
        <div class="col-xs-12">
            <div class="inv-listing-filter margin-lg-t5">
                <div class="inv-start-form">
                    <form method='POST'  action='/addresses/{{ $location->id }}/update'> 
                        {{ csrf_field() }}
                        <div class="{{ $errors->has('name')?'has-error':'' }}">
                            <label for="key">
                                <input id="key" type="text" name='name' value='{{ $location->name }}' >
                                <button  id="loc" type='submit' class='get-geolocation-btn'><i class="fa fa-map-marker"></i> Submit</button>

                            </label>
                            @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input id='markerLat' name='lat' value='' type="hidden">
                        <input id='markerLng' name='lng' value='' type='hidden'>
                      
                    </form>
                </div>
            </div>
            <div class="inv-listing-slider">
                <div class="inv-radius">
                    <input type="checkbox" id="inv-checkbox">
                    <label for="inv-checkbox">Radius: <span id="len"></span></label>
                </div>
                <div class="inv-slider-wrap">
                    <div class="slider noUi-target noUi-ltr noUi-horizontal " id="slider1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function initMap() {

        var locObject = {lat: <?php echo $location->latitude; ?>, lng: <?php echo $location->longitude; ?>};
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
            $(".get-geolocation-btn").click(function () {
                var currentLat = marker.getPosition().lat();
                var currentLng = marker.getPosition().lng();
                $('#markerLat').val(currentLat);
                $('#markerLng').val(currentLng);
            });
        });

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_f4hYIGUlqVctOk1Qa7qeYRzqsONK1K0&callback=initMap" async defer>
</script>


@endsection

