@extends('layouts.app')

@section('content')


            @if (!Auth::guest())
            @if (!Auth::user()->isAdmin())
              </br>
              </br>
            @endif
            @endif
            @if (Auth::guest())
              </br>
            @endif
            <h1 class="title is-1" style="text-align:center">Frizerski salon FER</h1>
            <div class="has-text-centered">
                Ova stranica namijenjena je korisnicima koji
                žele na brz i jednostavan način rezervirati termin kod svog
                omiljenog frizera. <strong>Potrebna je registracija.</strong>
            </div>
            </br>
            @if (Auth::guest())
              </br>
              </br>
            @endif
            <div class="tile is-ancestor is-vertical">
                <div class="is-parent tile">
                    <div class="is-child tile is-2">
                    </div>
                    <div class="is-child tile">

                        <br />
                        <input class="btn btn-success" type="button" id="routebtn" value="Prikaži put do salona" />
                        <div id="googleMap" style="width:100%;height:300px;"></div>
                    </div>
                    <div class="is-child tile is-1">
                    </div>
                    <div class="is-child tile">
                       <br /><br />

                        <h2 class="subtitle is-2">Info:</h2>
                        <div class="">
                            <p><strong>Naziv d.o.o.</strong>: FER</p>
                            <p><strong>Vlasnik</strong>: Ferko Ferković</p>
                            <p><strong>Kontakt mobitel</strong>: XXX-XXXX-XXX</p>
                            <p><strong>Kontakt telefon</strong>: XXX-XXX</p>
                            <p><strong>Adresa</strong>: Ozaljska ul. 2, 10000, Zagreb</p>

                        </div>
                    </div>
                </div>
            </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBitWg4KD1DYYOcFsHrnd18PGJpWCyOw40&callback=myMap"></script>
<script>
function mapLocation() {
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map, infoWindow;
    var start;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var lokacija = new google.maps.LatLng(45.7999211, 15.9536664);
        var mapOptions = {
            zoom: 17,
            center: lokacija
        };

        map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
        var marker = new google.maps.Marker({
            position: lokacija,
            map: map
        });
        directionsDisplay.setMap(map);

        infoWindow = new google.maps.InfoWindow;

        //geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                start = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
            }, function () {
                //nista ne pilaj korisnika
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
        google.maps.event.addDomListener(document.getElementById('routebtn'), 'click', calcRoute);
    }


    function calcRoute() {
        var end = new google.maps.LatLng(45.7999211, 15.9536664);

        var bounds = new google.maps.LatLngBounds();
        bounds.extend(start);
        bounds.extend(end);
        map.fitBounds(bounds);
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.WALKING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                directionsDisplay.setMap(map);
            } else {
                alert("Directions Request from " + start.toUrlValue(6) + " to " + end.toUrlValue(6) + " failed: " + status);
            }
        });
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
}
mapLocation();
</script>
@endsection
