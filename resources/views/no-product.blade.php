 <?php
 $url = config('app.url');
 ?>


 @extends('layouts.app')
 @section('content')

  <style>
 	#app,
 	body{
 		height: auto;
 	}
 	.main-con{
 		min-height: 50vh;
 	}
 </style>

<div class="wrap_home_single_product">


<div id="map" style="width: 100%;height: 50vh;"></div>
<!-- /#map -->

 <div class="container pt-0 mt-0 main-con">
 	<div class="row">

 		<div class="col-12">
 			<div class="wrap-logo-home-single">
 				<img class="logo-home-single" src="{{$url}}images/restaurants/{{$restaurant->logo}}" alt="">
 			</div>
 			<!-- /.wrap-logo-home-single -->

 			<h1 class="cat_name text-uppercase">
 				••• {{ $restaurant->name}} •••
 			</h1>
 			<p class="navbar_resto_desc text-center">
 				Il n'y a aucun produit .... <br>
 				<br>
 					<a class="btn btn-primary" href="{{route('vitrine')}}">retour</a>
 			</p>
 		</div>

 		<!-- /.col-12 -->







 	</div>
 </div>
 </div>
<!-- /.wrap_home_single_product -->
<div class="home-single-footer-infos">

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<h5>{{$restaurant->name}}</h5>
	<h6>{{$restaurant->mobile}}</h6>
	<p>{{$restaurant->address}}</p>
	<p>Suivez-nous</p>
	<p>... // ... // ...</p>
			</div>
			<!-- /.col-6 -->
			<div class="col-12 col-md-6"></div>
			<!-- /.col-6 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</div>
<!-- /.home-single-footer-infos -->

 @endsection

@section('footer-js')


 	<script src="{{$url}}/build/assets/leaflet.js"></script>

 	<script>



 				var startlat = {{$restaurant->lat}} ;
 				var startlon = {{$restaurant->lon}} ;

 				var options = {
 					center: [startlat, startlon],
 					zoom: 12
 				}

 				var map = L.map('map', options);
 				var nzoom = 6;

 				var greenIcon = L.icon({
 					iconUrl: '{{$url}}build/assets/img/star-1.png',

 					iconSize:    [50, 50] ,
 					iconAnchor:   [50, 50] ,
 					popupAnchor:  [-25, -25]
 				});

 				L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);

 				var myMarker = L.marker([startlat, startlon], {
 					title: "Coordinates",
 					alt: "Coordinates",
 					icon: greenIcon,
 					draggable: true
 				}).addTo(map).on('dragend', function() {
 					var lat = myMarker.getLatLng().lat.toFixed(8);
 					var lon = myMarker.getLatLng().lng.toFixed(8);
 					var czoom = map.getZoom();
 					if(czoom < 18) { nzoom = czoom + 2; }
 					if(nzoom > 18) { nzoom = 18; }
 					if(czoom != 18) { map.setView([lat,lon], nzoom); } else { map.setView([lat,lon]); }
 					document.getElementById('lat').value = lat;
 					document.getElementById('lon').value = lon;
 					myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
 					adress_by_lat_lon(lat, lon);
 				});


 	</script>



 	@endsection