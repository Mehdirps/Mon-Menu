 <?php $url = config('app.url'); ?>
 @extends('layouts.app')

 @section('content')

 <style>
 	#map{
 		width: 100%;
 		height: 200px;
 	}
 </style>

 @if($currentCategory->name == 'Ma première catégorie' && Auth::user()->isAdmin())
 <style>

 	#app{
 		height: auto!important;
 	}

 	.cat_name{
 		max-width: 500px;
 		margin-left: auto;
 		margin-right: auto;
 	}

 	.modal-footer br {
 		display: none;
 	}

 	.col-sm-9.col-8.main{
 		/*flex: 0 0 auto;*/
 		width: 100%;
 		height: calc(100vh - 30px);
 		overflow: hidden;
 	}

 	.col-4.col-sm-3.sidebar{
 		width: 0;
 		overflow: hidden;
 		left: -999px;
 		position: absolute;
 	}

 	.wrap_text_welcome {
 		max-width: 500px;
 		margin-left: auto;
 		margin-right: auto;
 	}
 	.cat_name,
 	.superplus,
 	.rows{
 		display: none;
 	}

 	.wrap_img_cat{
 		padding: 0;
 	}

 	.sidebar form#delete-form-1,
 	.sidebar a#idupdatecat,
 	.sidebar img,
 	a#updateresto,
 	.sidebar a#idaddcat,
 	.sidebar h4 {
 		display:none
 	}



 	a.navbar-brand img {
 		display:block
 	}

 </style>
 @endif


 @include('partial.crud.update-infos')



 <span class="superplus">
 	<span>
 		<svg fill="none" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="rgb(0,0,0)" fill-rule="evenodd"><path d="m1.25 12c0-5.93706 4.81294-10.75 10.75-10.75 5.9371 0 10.75 4.81294 10.75 10.75 0 5.9371-4.8129 10.75-10.75 10.75-5.93706 0-10.75-4.8129-10.75-10.75zm10.75-9.25c-5.10864 0-9.25 4.14136-9.25 9.25 0 5.1086 4.14136 9.25 9.25 9.25 5.1086 0 9.25-4.1414 9.25-9.25 0-5.10864-4.1414-9.25-9.25-9.25z"/><path d="m12 7.25c.4142 0 .75.33579.75.75v8c0 .4142-.3358.75-.75.75s-.75-.3358-.75-.75v-8c0-.41421.3358-.75.75-.75z"/><path d="m7.25 12c0-.4142.33579-.75.75-.75h8c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-8c-.41421 0-.75-.3358-.75-.75z"/></g></svg>
 	</span>
 </span>
 <!-- /.superplus -->


 <div class="container-fluid pt-0 mt-0">
 	<div class="row">

 		<div class="col-4 col-sm-3 sidebar">

 			<div class="wrap_logo">
 				<a class="navbar-brand" href="{{ route('home' ,[null, null]) }}">
 					@if($restaurant)
 					<img src="images/restaurants/{{$restaurant->logo}}" alt="">
 					@endif
 				</a>
 				@if (Auth::user() && Auth::User()->isAdmin())
 				<a href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_logo" id="updateresto" class="updateresto">
 					<i class="fa fa-edit"></i> Modifier les infos
 				</a>
 				@endif
 			</div>

 			<div class="col-12">
 				<a href="#" class="reduire" id="reduire">Réduire le menu</a>
 			</div>

 			@foreach($mainCategories as $category)

 			<?php $class = $currentCategory->id === $category->id ? 'active' : '' ;?>

 			@include('partial.category', ['category' => $category, 'class' => $class])

 			@endforeach
 			@include('partial.crud.add-category', ['category' => $category, 'class' => $class , 'main' => 1 ])
 		</div>




 		<div class="col-sm-9 col-8 main">
 			<div class="row">

 				<div class="col-12 wrap_img_cat">
 					<span class="noise"></span>

 					@if($currentCategory->name == 'Ma première catégorie' && Auth::user()->isAdmin())

 					<img style="object-fit: cover;height: 150%;width: 150%;position: relative;z-index: 0;" src="{{ asset('img/gold-cutlery-set-black-background.jpg' )}}" alt="">
 					@else

 					<div class="wrap_img_cat_bg" style="background-image: url({{ asset('images/'.$currentCategory->image)}});" >

 					</div>
 					<img src="{{ asset('images/'.$currentCategory->image )}}" alt="{{ $currentCategory->name}}">
 					@endif

 				</div>





 				<h1 class="cat_name text-uppercase">{{-- Accueil / --}}
 					••• {{ $currentCategory->name}} ••• </h1>

 					<div class="rows">
 						<div class="main_category row"> <!-- main_product -->
 							@if(isset($categories) && $categories)
 							<?php $i = 0 ;?>
 							@foreach($categories as $categorie)
 							@include('partial.category', ['category' => $categorie, 'class' => 'col-6 col-md-4 wrap_card_cat wrap_card_cat-'.$i.''])
 							<?php $i++ ;?>
 							@endforeach
 							@endif
 							@include('partial.crud.add-category', ['category' => $category, 'class' => $class , 'main' => 0 ])
 						</div>

 						<div class="main_product row"> <!-- main_product -->
 							@foreach($products as $product)
 							@include('partial.product', ['product' => $product, 'class' => ''])
 							@endforeach
 							@include('partial.crud.add-product')
 						</div> <!-- main_product -->
 					</div>
 				</div>

 				<div class="footer">Propulsé par maplaque-nfc.fr</div>
 			</div>
 		</div>

 	</div>




 	@endsection

 	@section('footer-js')
 	<script>
 		$(document).ready(function(){



 			$('.superplus').click(function (e) {
 				$('.superplus').addClass('cache');
 				$('.main .btn_product_add').addClass('open');
 				$('.main .add_sous_cat').addClass('open');
 			})


 			$('.main .btn_product_add,.main .add_sous_cat, .col-8.main').click(function () {
 				$('.superplus').removeClass('cache');
 				$('.main .btn_product_add').removeClass('open');
 				$('.main .add_sous_cat').removeClass('open');
 			})



 			@error('image','name')
 			$('#modal_category_add').modal('show')
 			@enderror
			// $('#modal_category_add').modal('show')
		});


 		@if($currentCategory->name == 'Ma première catégorie' && Auth::user()->isAdmin())

 		$('.col-4.col-sm-3.sidebar').css({
 			'width': 0,
 			'overflow': 'hidden',
 			'left': '-999px',
 			'position': 'absolute',
 		});

 		$('.col-4.col-sm-3.sidebar').removeClass('mini-side');

 		$('.rows').html(`
 			<div class="wrap_text_welcome">
 			<p class="text-center">
 			Depuis votre espace vous pouvez ajouter une catégorie, des sous catégories, des produits, gérer vos préferences de couleurs et bien d'autres choses encore
 			</p>
 			<div class="text-center">
 			<a class="text-center ml-auto mr-auto idupdatecat--" href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_category_{{$currentCategory->id}}" id="idupdatecat">Commencer a remplir mon menu</a>

 			<div class="text-center mt-4 ">
 			<a href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_logo" id="" class="" style="color:#d3a868">
 			<i class="fa fa-edit"></i> Modifier les infos de mon restaurant
 			</a>
 			</div>
 			</div>


 			</div>
 			`);
 		$('.cat_name').html('Bonjour {{$user->name}},<br> Bienvenue dans votre application de gestion de votre carte pour votre restaurant {{$restaurant->name}} ');
 		$('.cat_name').addClass('grosse');

 		$('.rows,.cat_name').show()

 		@endif
 	</script>


 	<script src="{{$url}}/build/assets/leaflet.js"></script>

 	<script>




function chooseAddr(lat1, lng1)
 				{
 					myMarker.closePopup();
 					map.setView([lat1, lng1],15);
 					myMarker.setLatLng([lat1, lng1]);
 					lat = lat1.toFixed(8);
 					lon = lng1.toFixed(8);
 					document.getElementById('lat').value = lat;
 					document.getElementById('lon').value = lon;
 					myMarker.bindPopup("Latitude : "+lat+" <br> Longitude "+lon+"  ").openPopup();
 				}

 				function myFunction(arr)
 				{
 					var out = "<br />";
 					var i;

 					if(arr.length > 0)
 					{
 						for(i = 0; i < arr.length; i++)
 						{
 							out += "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat + ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
 						}
 						document.getElementById('results').innerHTML = out;
 					}
 					else
 					{
 						document.getElementById('results').innerHTML = "Pas de résultat...";
 					}

 					jQuery('#results').show();

 				}


 				function adress_search()
 				{
 					var inp = document.getElementById("address");
 					var xmlhttp = new XMLHttpRequest();
 					var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
 					xmlhttp.onreadystatechange = function()
 					{
 						if (this.readyState == 4 && this.status == 200)
 						{
 							var myArr = JSON.parse(this.responseText);
 							myFunction(myArr);
 						}
 					};
 					xmlhttp.open("GET", url, true);
 					xmlhttp.send();
 				}

 				function adress_by_lat_lon(lat, lon)
 				{
 					var xmlhttp = new XMLHttpRequest();
 					var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q="+lat+"+" + lon;
 					xmlhttp.onreadystatechange = function()
 					{
 						if (this.readyState == 4 && this.status == 200)
 						{
 							var myArr = JSON.parse(this.responseText);
 							jQuery('#address').val(myArr[0].display_name);
 							console.log('myArr.display_name', myArr[0].display_name);
 						}
 					};
 					xmlhttp.open("GET", url, true);
 					xmlhttp.send();
 				}


 		jQuery( "body" ).on( "click", "#updateresto", function() {

 			jQuery('.wrap_map').html('');
 			jQuery('.wrap_map').html('<div id="map" style="width: 100%;height: 250px;"></div>');

 			setTimeout(function() {


 				var startlat = {{$user->restaurant->lat}} ;
 				var startlon = {{$user->restaurant->lon}} ;

 				var options = {
 					center: [startlat, startlon],
 					zoom: 5
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


 				jQuery( "body" ).on( "keyup", "#address", function() {
 					jQuery('#search button').click();
 				})

 				jQuery( "body" ).on( "click", ".address", function() {
 					txt = jQuery( this ).text();
 					jQuery('#address').val(txt);
 					jQuery('#results').hide();
 				});



 			}, 250);



 		});


 	</script>



 	@endsection
