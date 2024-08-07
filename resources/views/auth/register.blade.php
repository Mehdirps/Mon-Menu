 <?php $url = config('app.url'); ?>
 @extends('layouts.new-app')


 @section('app-content')
     <section class="form-container">
         <div class="form">
             <h1>Création de votre compte</h1>
             <form method="POST" action="{{ route('register') }}">
                 @csrf
                 <div class="form-input-container">
                     <input id="name" placeholder="Votre nom" type="text"
                         class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                         required autocomplete="name" autofocus>


                         <?php if (isset($_GET['parrain_id'])): ?>

                             <input id="parrain_id" type="hidden" name="parrain_id"
                         required autocomplete="parrain_id" value="<?=  $_GET['parrain_id'] ?>">


                         <?php endif; ?>


                     @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                         @enderror
                         <input id="restoname" placeholder="Le nom de votre entreprise" type="text"
                             class="form-control @error('restoname') is-invalid @enderror" name="restoname"
                             value="{{ old('restoname') }}" required autocomplete="restoname">

                         @error('restoname')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                         <input id="mobile" placeholder="Téléphone" type="text"
                             class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                             value="{{ old('mobile') }}" required autocomplete="mobile">
                         @error('mobile')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                 </div>
                 <div class="form-input">
                 </div>
                 <div class="form-input-address">
                     <div id="search">
                         <!-- search -->
                         <button style="display: none" type="button" onclick="adress_search();">Recherche</button>

                         <input id="address" placeholder="Adresse" type="text"
                             class="form-control @error('address') is-invalid @enderror" name="address"
                             value="{{ old('address') }}" required autocomplete="address">
                             <div class="wrap_results">
                                 <div id="results"></div>
                             </div>
                         <div id="map"></div>
                     </div>
                     <input id="lat" placeholder="lat" type="text"
                         class="form-control @error('lat') is-invalid @enderror" name="lat" value="{{ old('lat') }}"
                         required autocomplete="lat">

                     <input id="lon" placeholder="lon" type="text"
                         class="form-control @error('lon') is-invalid @enderror" name="lon" value="{{ old('lon') }}"
                         required autocomplete="lon">
                     @error('address')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                 </div>
                 <div class="form-input-container">
                     <input id="email" placeholder="Votre email" type="email"
                         class="form-control @error('email') is-invalid @enderror" name="email"
                         value="{{ old('email') }}" required autocomplete="email">

                     @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                     <input id="password" placeholder="Mot de passe" type="password"
                         class="form-control @error('password') is-invalid @enderror" name="password" required
                         autocomplete="new-password">

                     @error('password')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                     <input id="password-confirm" placeholder="Confirmation du mot de passe" type="password"
                         class="form-control" name="password_confirmation" required autocomplete="new-password">
                 </div>
                 <div class="form-input">
                 </div>
                 <div class="form-input">
                 </div>
                 <button type="submit" class="btn btn-primary">
                     {{ __('Création de compte') }}
                 </button>
             </form>
         </div>
     </section>
 @endsection

 @section('app-footer-js')
     <script src="{{ $url }}/build/assets/leaflet.js"></script>
     <script src="https://code.jquery.com/jquery-3.7.0.min.js"
         integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
     <script>
         var startlat = 46.31658418;

         var startlon = 2.46093750;




         var options = {
             center: [startlat, startlon],
             zoom: 5
         }


         document.getElementById('lat').value = startlat;
         document.getElementById('lon').value = startlon;

         var map = L.map('map', options);
         var nzoom = 6;

         var greenIcon = L.icon({
             iconUrl: '{{ $url }}build/assets/img/star-1.png',

             iconSize: [50, 50], // size of the icon
             iconAnchor: [50, 50], // point of the icon which will correspond to marker's location
             popupAnchor: [-25, -25] // point from which the popup should open relative to the iconAnchoriconAnchor
         });

         L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
             attribution: 'OSM'
         }).addTo(map);

         var myMarker = L.marker([startlat, startlon], {
             title: "Coordinates",
             alt: "Coordinates",
             icon: greenIcon,
             draggable: true
             // draggable: false
         }).addTo(map).on('dragend', function() {
             var lat = myMarker.getLatLng().lat.toFixed(8);
             var lon = myMarker.getLatLng().lng.toFixed(8);
             var czoom = map.getZoom();
             if (czoom < 18) {
                 nzoom = czoom + 2;
             }
             if (nzoom > 18) {
                 nzoom = 18;
             }
             if (czoom != 18) {
                 map.setView([lat, lon], nzoom);
             } else {
                 map.setView([lat, lon]);
             }
             document.getElementById('lat').value = lat;
             document.getElementById('lon').value = lon;
             myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
             adress_by_lat_lon(lat, lon);
             // jQuery('#addr').val(jQuery('.address').eq(0).text());

         });

         function chooseAddr(lat1, lng1) {
             myMarker.closePopup();
             map.setView([lat1, lng1], 15);
             myMarker.setLatLng([lat1, lng1]);
             lat = lat1.toFixed(8);
             lon = lng1.toFixed(8);
             document.getElementById('lat').value = lat;
             document.getElementById('lon').value = lon;
             myMarker.bindPopup("Latitude : " + lat + " <br> Longitude " + lon + "  ").openPopup();
         }

         function myFunction(arr) {
             var out = "<br />";
             var i;

             if (arr.length > 0) {
                 for (i = 0; i < arr.length; i++) {
                     out += "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat +
                         ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
                 }
                 document.getElementById('results').innerHTML = out;
             } else {
                 document.getElementById('results').innerHTML = "Pas de résultat...";
             }

             jQuery('#results').show();

         }


         function adress_search() {
             var inp = document.getElementById("address");
             var xmlhttp = new XMLHttpRequest();
             var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
             xmlhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                     var myArr = JSON.parse(this.responseText);
                     myFunction(myArr);
                 }
             };
             xmlhttp.open("GET", url, true);
             xmlhttp.send();
         }

         function adress_by_lat_lon(lat, lon) {
             var xmlhttp = new XMLHttpRequest();
             var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + lat + "+" + lon;
             xmlhttp.onreadystatechange = function() {
                 if (this.readyState == 4 && this.status == 200) {
                     var myArr = JSON.parse(this.responseText);
                     jQuery('#address').val(myArr[0].display_name);
                     console.log('myArr.display_name', myArr[0].display_name);
                 }
             };
             xmlhttp.open("GET", url, true);
             xmlhttp.send();
         }

         jQuery('#address').on('keyup', function() {
             jQuery('#search button').click();
         })

         jQuery("body").on("click", ".address", function() {
             txt = jQuery(this).text();
             jQuery('#address').val(txt);
             jQuery('#results').hide();
         });
     </script>
 @endsection
