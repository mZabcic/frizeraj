@extends('layouts.app')

@section('content')
<section class="hero-body is-primary is-bold">
    <!--Zaglavlje -->
    <!--
                Ovdje nadodati uvjete da se prikazuje ovisno o tom je li korisnik, gost ili admin.

            -->

    <div class="hero-head">
        <br />
        <br />
        <br />
        <h1 class="title is-1" style="text-align:center">Frizerski salon FER</h1>
    </div>

    <!-- Sredina -->
    <div class="hero-body">
            <div class="tile is-ancestor is-vertical">
                <div class="is-parent tile">
                    <div class="is-child tile is-2">
                    </div>
                    <div class="is-child tile" style="text-align:center">
                        <div class="has-text-centered">
                            Ova stranica namijenjena je korisnicima koji
                            žele na brz i jednostavan način rezervirati termin kod svog
                            omiljenog frizera. <strong>Potrebna je registracija.</strong>
                        </div>
                        <br />
                        <div id="googleMap" style="width:100%;height:300px;"></div>
                    </div>
                    <div class="is-child tile is-1">
                    </div>
                    <div class="is-child tile">
                       <br /><br /><br /><br />

                        <h2 class="subtitle is-2">Info:</h2>
                        <div class="">
                            <p><strong>Naziv d.o.o.</strong>: FER</p>
                            <p><strong>Vlasnik</strong>: Ferko Ferković</p>
                            <p><strong>Kontakt mobitel</strong>: XXX-XXXX-XXX</p>
                            <p><strong>Kontakt telefon</strong>: XXX-XXX</p>
                            <p><strong>Adresa</strong>: Unska ul. 3, 10000, Zagreb</p>

                        </div>
                    </div>
                </div>
            </div>
     </div>

    <!-- Kraj -->
    <div class="hero-foot">

    </div>
</section>

<script>
    function myMap() {
        var lokacija = new google.maps.LatLng(45.800661, 15.9707981);
        var mapProp = {
            center: lokacija,
            zoom: 17,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        var marker = new google.maps.Marker({
            position: lokacija,
            map: map
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBitWg4KD1DYYOcFsHrnd18PGJpWCyOw40&callback=myMap"></script>

@endsection
