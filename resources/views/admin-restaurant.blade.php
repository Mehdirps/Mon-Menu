<?php
$url = config('app.url');
?>


@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="./build/assets/app.css">

    <style>
        #app,
        body {
            height: auto;
        }

        .col.col-4.col-categorie.mb-4 {
            display: flex;
            /*background: red;*/
        }

        a#idaddcat {
            font-size: 13px;
        }

        .col.col-4.col-categorie.mb-4 .card {
            height: 100%;
            /*background: blue;*/
            display: flex;
        }

        .col.col-4.col-categorie.mb-4 .card .rombel {
            height: 100%;
            /*background: #8585f9;*/
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
    </style>


    @if (auth()->check())
        @if ($user->id== $restaurant->admin_id)
            @include('partial.crud.update-infos')
            {{--


<span class="superplus">
 	<span>
 		<svg fill="none" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg"><g clip-rule="evenodd" fill="rgb(0,0,0)" fill-rule="evenodd"><path d="m1.25 12c0-5.93706 4.81294-10.75 10.75-10.75 5.9371 0 10.75 4.81294 10.75 10.75 0 5.9371-4.8129 10.75-10.75 10.75-5.93706 0-10.75-4.8129-10.75-10.75zm10.75-9.25c-5.10864 0-9.25 4.14136-9.25 9.25 0 5.1086 4.14136 9.25 9.25 9.25 5.1086 0 9.25-4.1414 9.25-9.25 0-5.10864-4.1414-9.25-9.25-9.25z"/><path d="m12 7.25c.4142 0 .75.33579.75.75v8c0 .4142-.3358.75-.75.75s-.75-.3358-.75-.75v-8c0-.41421.3358-.75.75-.75z"/><path d="m7.25 12c0-.4142.33579-.75.75-.75h8c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-8c-.41421 0-.75-.3358-.75-.75z"/></g></svg>
 	</span>
 </span>

 --}}
        @endif
    @endif


    <div class="wrap_home_single_product">
        @if ($restaurant->banner)
            <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->banner }}"
                alt="Image de la categorie {{ $restaurant->name }}" style="width: 100%; height: 50vh">
        @else
            <img src="{{ $url }}images/default-banner.jpg" alt="Bannière par default"
                style="width: 100%; height: 50vh">
        @endif
        <div class="container pt-0 mt-0">
            <div class="row">

                <div class="col-12 super-rel">
                    <div class="wrap-logo-home-single">
                        <a href="{{ route('restaurant', $restaurant->id) }}">
                            <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->logo }}"
                                alt="Logo du restaurant {{ $restaurant->name }}">
                        </a>
                    </div>
                    <!-- /.wrap-logo-home-single -->

                    <h1 class="cat_name text-uppercase">
                        ••• {{ $restaurant->name }} •••
                    </h1>


                    @if (auth()->check())
                        @if ($user->id== $restaurant->admin_id)

                            <hr>


                            <div class="open-blocs">
                                <a class="open-bloc" href="#" data-link=".show_infos_blocs">Mes infos</a>
                                <a class="open-bloc" href="#" data-link=".show_cats_blocs">Mes Catégories</a>
                                <a class="open-bloc" href="#" data-link=".show_products_blocs">Mes Produits</a>

                                <a class=" open-bloc-dec" href="{{ route('logout') }}"><small>Deconnexion</small></a>
                            </div>
                            <!-- /.open-blocs -->
                            <!-- / -->


                            <div class="bloc_infs show_infos_blocs">
                                <div>
                                    <p>Mon nom :
                                        <strong>{{ $user->name }}</strong>
                                    </p>
                                    <p>Mon email :
                                        <strong>{{ $user->email }}</strong>
                                    </p>
                                    <p>Le nom du restaurant :
                                        <strong>{{ $user->restaurant->name }}</strong>
                                    </p>
                                    <p>Le numéro de téléphone du restaurant :
                                        <strong>{{ $user->restaurant->mobile }}</strong>
                                    </p>
                                    <p>L'adresse du restaurant :
                                        <strong>{{ $user->restaurant->address }}</strong>
                                    </p>
                                    <p>La description du restaurant :
                                        <strong>{{ $user->restaurant->content }}</strong>
                                    </p>
                                    <p>Lien facebook :
                                        <strong>{{ $user->restaurant->facebook }}</strong>
                                    </p>
                                    <p>Lien instagram :
                                        <strong>{{ $user->restaurant->instagram }}</strong>
                                    </p>
                                    <p>Lien tripadvisor :
                                        <strong>{{ $user->restaurant->tripadvisor }}</strong>
                                    </p>
                                    <p>Lien site :
                                        <strong>{{ $user->restaurant->website }}</strong>
                                    </p>
                                    <p>Lien tiktok :
                                        <strong>{{ $user->restaurant->tiktok }}</strong>
                                    </p>
                                    <p>Horaire du lundi:
                                        <strong>{{ $user->restaurant->lundi }}</strong>
                                    </p>
                                    <p>Horaire du mardi:
                                        <strong>{{ $user->restaurant->mardi }}</strong>
                                    </p>
                                    <p>Horaire du mercredi:
                                        <strong>{{ $user->restaurant->mercredi }}</strong>
                                    </p>
                                    <p>Horaire du jeudi:
                                        <strong>{{ $user->restaurant->jeudi }}</strong>
                                    </p>
                                    <p>Horaire du vendredi:
                                        <strong>{{ $user->restaurant->vendredi }}</strong>
                                    </p>
                                    <p>Horaire du samedi:
                                        <strong>{{ $user->restaurant->samedi }}</strong>
                                    </p>
                                    <p>Horaire du dimanche:
                                        <strong>{{ $user->restaurant->dimanche }}</strong>
                                    </p>
                                    <hr />

                                    <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal-update_logo">
                                        <i class="fa fa-edit"></i> Modifier mes infos
                                    </a>
                                    <!-- /.btn btn-primary -->
                                </div>
                            </div>
                            <!-- /.show_infos_blocs -->

                            <div class="bloc_infs show_products_blocs">
                                <p>Mes Produits</p>

                                <div class="row">

                                    <script>
                                        function confirmDeleteP(categoryId, categoryName) {
                                            if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ( " + categoryName + " " + categoryId +
                                                    "  ) ?")) {
                                                document.getElementById('delete-form-' + categoryId).submit();
                                            }
                                        }
                                    </script>


                                    @if (count($products) > 0)
                                        @foreach ($products as $product)
                                            <div class="product col-4 col-sm-6 col-md-3 py-4">
                                                <div class="row">
                                                    <div class="col-6 product-img">
                                                        <!-- col-12 -->
                                                        <div class="wrap_img">
                                                            <!-- wrap_img -->
                                                            @if ($product->image)
                                                                <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}"
                                                                    alt="Image de la categorie {{ $product->name }}">
                                                            @else
                                                                <img src="{{ $url }}images/default.png"
                                                                    alt="Image par default">
                                                            @endif
                                                        </div> <!-- wrap_img -->
                                                    </div> <!-- col-12 -->
                                                    <div class="col-12 text-center">
                                                        <h1>{{ $product->name }}</h1>
                                                    </div>


                                                    <a href="#" title="" data-bs-toggle="modal"
                                                        data-bs-target="#modal-update_product-{{ $product->id }}"
                                                        class="updateproduct text-center d-block mt-3">
                                                        <i class="fa fa-edit"></i> Modifier
                                                    </a>

                                                    <form id="delete-form-{{ $product->id }}"
                                                        action="{{ route('deleteprod', $product->id) }}" method="POST"
                                                        enctype="multipart/form-data" class="delete-form">
                                                        @csrf
                                                        @method('delete')
                                                        <small>
                                                            <button type="button" class="text-danger mt-4 d-block"
                                                                onclick="confirmDeleteP({{ $product->id }}, '{{ $product->name }}' )">
                                                                <i class="fa fa-trash"></i> Supprimer
                                                            </button>
                                                        </small>
                                                    </form>



                                                    @include('partial.crud.update-product')





                                                </div><!-- /.row -->
                                            </div><!-- /.product -->
                                        @endforeach
                                    @else
                                        <p>Aucun produit trouvé.</p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.show_infos_blocs -->

                            <div class="bloc_infs show_cats_blocs">


                                <p>Mes Catagories</p>


                                <div class="row">

                                    @foreach ($mainCategories as $category)
                                        @if ($category)
                                            @if ($category->name == 'Ma première catégorie')
                                                <style>
                                                    .col-add-cat-home {
                                                        display: none
                                                    }
                                                </style>

                                                <a href="#" title="" data-bs-toggle="modal"
                                                    data-bs-target="#modal-update_category_{{ $category->id }}"
                                                    id="idupdatecat">
                                                    Création de ma premiere catégorie
                                                </a>
                                            @else
                                                <div class="col col-4 col-categorie mb-4 ">
                                                    <div class="card">
                                                        <!-- card -->
                                                        <div class="rombel">

                                                            <!-- lien -->
                                                            <a class="category-link"
                                                                href="{{ route('singlecat', [$restaurant->id, $category->id, $category->slug]) }}">
                                                                @if ($category->image)
                                                                    <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $category->image }}"
                                                                        alt="Image de la categorie {{ $category->name }}">
                                                                @else
                                                                    <img src="{{ $url }}images/default.png"
                                                                        alt="Image par default">
                                                                @endif
                                                                <span class="curved-container">
                                                                    <h4>{{ $category->name }}</h4>
                                                                </span>
                                                            </a>

                                                            <a href="#" title="" data-bs-toggle="modal"
                                                                data-bs-target="#modal-update_category_{{ $category->id }}"
                                                                id="idupdatecat">
                                                                <i class="fa fa-edit"></i> Modifier
                                                            </a>
                                                            <!-- lien -->
                                                            <br>

                                                            <form id="delete-form-{{ $category->id }}"
                                                                action="{{ route('deletecat', $category->id) }}"
                                                                method="POST"
                                                                class="delete-form">
                                                                @csrf
                                                                @method('delete')
                                                                <small>
                                                                    <button type="button" class="text-danger mt-4 d-block"
                                                                        onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}' )">
                                                                        <i class="fa fa-trash"></i> Supprimer
                                                                    </button>
                                                                </small>
                                                            </form>




                                                            <div class="modal fade"
                                                                id="modal-update_category_{{ $category->id }}"
                                                                tabindex="-1" aria-labelledby="" aria-hidden="true">
                                                                <!-- Modal -->
                                                                <div class="modal-dialog">
                                                                    <!-- dialog -->
                                                                    <div class="modal-content">
                                                                        <!-- content -->
                                                                        <div class="modal-header">
                                                                            <!-- header -->
                                                                            <h5 class="modal-title">Mettre à jour une
                                                                                categorie </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div> <!-- header -->
                                                                        <form id=""
                                                                            action="{{ route('updatecat', $category->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-body">
                                                                                <!-- modal-body -->
                                                                                <!-- form-group -->
                                                                                <div class="form-group">
                                                                                    <label for="name">Nom de la
                                                                                        catégorie</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="name" name="name"
                                                                                        required="required"
                                                                                        placeholder="Nom de la catégorie"
                                                                                        value="{{ $category->name }}">
                                                                                </div>
                                                                                <!-- form-group -->

                                                                                <!-- form-group -->
                                                                                <div class="form-group mt-4">
                                                                                    <img id="imagePreview" src="#"
                                                                                        alt="Aperçu de l'image"
                                                                                        class="mb-4"
                                                                                        style="display: none;width: 100%;">
                                                                                    <label for="image">Image</label>
                                                                                    <input type="file"
                                                                                        class="form-control-file"
                                                                                        id="image" name="image">
                                                                                </div>
                                                                                <!-- form-group -->

                                                                                <input type="hidden" name="parent_id"
                                                                                    value="{{ $currentCategory->id }}">
                                                                            </div> <!-- modal-body -->
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                    <i class="fas fa-edit"></i>
                                                                                    Modifier la catégorie
                                                                                </button>
                                                                                <br>
                                                                                <div id="errorMessages"
                                                                                    class="text-danger"
                                                                                    style="display: none;"></div>
                                                                                @error('image')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- content -->
                                                                </div> <!-- dialog -->
                                                            </div> <!-- Modal -->
                                                        </div> <!-- rombel -->
                                                    </div> <!-- card -->
                                                </div> <!-- col-categorie -->
                                            @endif
                                        @endif
                                    @endforeach



                                    @if (auth()->check())
                                        @if ($user->id== $restaurant->admin_id)
                                            @if (isset($category))
                                                <div class="col col-4 col-categorie col-add-cat-home">
                                                    <div class="card">
                                                        <!-- card -->
                                                        @include('partial.crud.add-category', [
                                                            'category' => $category,
                                                            'class' => ' ',
                                                            'main' => 1,
                                                        ])
                                                    </div> <!-- card -->
                                                </div> <!-- col-categorie -->
                                            @endif
                                        @endif
                                    @endif




                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.show_infos_blocs -->

                        @endif
                    @endif





                    <p class="navbar_resto_desc">
                        {{ $restaurant->content }}
                    </p>
                </div>

                <!-- /.col-12 -->

                <!-- cate ici pour guest et connect pas resto id -->











            </div>
        </div>
    </div>
    <!-- /.wrap_home_single_product -->
    <div class="home-single-footer-infos">
        <p class="thanks">Merci d'utiliser MonMenu.io propoulsé par<a href="https://maplaque-nfc.fr" target="_blank"> MaPlaqueNFC</a> ! Toute l'équipe vous
            en remercie !</p>
    </div>
    <!-- /.home-single-footer-infos -->
    <style>
        .thanks {
            font-size: 16px !important;
            text-align: center;
            
        }
    </style>
@endsection

@section('footer-js')
    <script>
        $(document).ready(function() {

            $('.open-bloc').click(function(e) {
                e.preventDefault();
                $cls = $(this).data('link');
                $('.open-bloc').removeClass('active');
                $(this).addClass('active');
                if ($($cls).hasClass('open')) {
                    $($cls).removeClass('open');
                    return
                }

                $('.bloc_infs').removeClass('open');



                $($cls).addClass('open');
            })
            $('.open-bloc').eq(1).click();
            $('.superplus').click(function(e) {
                $('.superplus').addClass('cache');
                $('.main .btn_product_add').addClass('open');
                $('.main .add_sous_cat').addClass('open');
            })


            $('.main .btn_product_add,.main .add_sous_cat, .col-8.main').click(function() {
                $('.superplus').removeClass('cache');
                $('.main .btn_product_add').removeClass('open');
                $('.main .add_sous_cat').removeClass('open');
            })



            @error('image', 'name')
                $('#modal_category_add').modal('show')
            @enderror
            // $('#modal_category_add').modal('show')
        });


        @if ($currentCategory->name == 'Ma première catégorie' && Auth::user()->isAdmin())

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
 		<a class="text-center ml-auto mr-auto idupdatecat--" href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_category_{{ $currentCategory->id }}" id="idupdatecat">Commencer a remplir mon menu</a>

 		<div class="text-center mt-4 ">
 		<a href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_logo" id="" class="" style="color:#d3a868">
 		<i class="fa fa-edit"></i> Modifier les infos de mon restaurant
 		</a>
 		</div>
 		</div>


 		</div>
 		`);
            $('.cat_name').html(
                'Bonjour {{ $user->name }},<br> Bienvenue dans votre application de gestion de votre carte pour votre restaurant {{ $restaurant->name }} '
            );
            $('.cat_name').addClass('grosse');

            $('.rows,.cat_name').show()
        @endif
    </script>


    <script>
        function confirmDelete(categoryId, categoryName) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ( " + categoryName + "    " + categoryId +
                    "  ) ? Cela supprimera toutes les sous catégories associées ainsi que leurs produits")) {
                document.getElementById('delete-form-' + categoryId).submit();
            }
        }
    </script>




    <script src="{{ $url }}/build/assets/leaflet.js"></script>

    <script>
        var startlat = {{ $restaurant->lat }};
        var startlon = {{ $restaurant->lon }};

        var options = {
            center: [startlat, startlon],
            zoom: 12
        }

        var map = L.map('map', options);
        var nzoom = 6;

        var greenIcon = L.icon({
            iconUrl: '{{ $url }}build/assets/img/star-1.png',

            iconSize: [50, 50],
            iconAnchor: [50, 50],
            popupAnchor: [-25, -25]
        });

        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'OSM'
        }).addTo(map);

        var myMarker = L.marker([startlat, startlon], {
            title: "Coordinates",
            alt: "Coordinates",
            icon: greenIcon,
            draggable: true
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
        });
    </script>
@endsection
