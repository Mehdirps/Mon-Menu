<?php

$url = 'https://monmenu.io/menus/';

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ $url }}dashboard-assets/img/apple-icon.png">

    <link rel="shortcut icon" href="{{ $url }}img/favicon.png" type="image/x-icon">

    <title>

        Espace d'administration

    </title>

    <!--     Fonts and icons     -->

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />

    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Nucleo Icons -->

    <link href="{{ $url }}dashboard-assets/css/nucleo-icons.css" rel="stylesheet" />

    <!-- CSS Files -->

    <link href="{{ $url }}dashboard-assets/css/dash.css?v=1.0.0" rel="stylesheet" />

    <!-- Leaflet -->

    <link href="{{ $url }}dashboard-assets/css/leaflet.css" rel="stylesheet" />

    <link href="{{ $url }}dashboard-assets/css/custom.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->

    {{-- <link href="{{ $url }}dashboard-assets/demo/demo.css" rel="stylesheet" /> --}}

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <style>







        .tr_cat,

        .tr_cat>* {

            transition: opacity 250ms ease-out;

        }



        .tr_cat.hide {



            opacity: 0;

            height: 0;

            overflow: hidden;

            width: 100%;

            padding: 0;

            position: absolute;

        }



        .tr_cat.hide>* {

            opacity: 0;

            max-height: 0;

            max-width: 0;

            overflow: hidden;

            width: 100%;

            padding: 0;

            font-size: 0;



        }



        .tr_cat.hide img {

            display: none

        }





        .wrap_colors {

            display: flex;

            border: 1px solid #6e6e6e;

            padding: 10px;

            margin-bottom: 30px;

            position: relative;

            /*height: 47px;*/

        }



        .wrap_colors input {

            width: 100%;

            height: 47px;

        }





        .clear_color {

            position: absolute;

            right: 10px;

            width: 47px;

            height: 47px;

            display: flex;

            align-items: center;

            justify-content: center;

            cursor: pointer;

            background-color: #fff;

            border-left: 1px solid #000;

            z-index: 10;

        }



        @media (min-width:700px) {

            .navbar-brand br {

                display: none;

            }



            .navbar-brand {

                top: 10px;

            }

        }



        .select2-container {

            min-width: 100%;

            text-transform: capitalize

        }



        .img-flag {

            width: 20px;

            height: 20px;

            margin-right: 10px

        }

    </style>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>





    <!-- Inclure la bibliothèque jspdf-autotable -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.js"></script>



<script async src="https://www.googletagmanager.com/gtag/js?id=G-9Z9VHBG5H0"></script>



<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'G-9Z9VHBG5H0');

</script>





</head>





@if (isset($_GET['task']))

    @php $task = $_GET['task']; @endphp

@else

    @php $task = ''; @endphp

@endif



<body class="white-content">







    <div id="footer-info" style="display: none;">www.monmenu.io</div>

    <!-- /#footer-info -->



    <div class="wrapper">

        <div class="sidebar">

            <div class="sidebar-wrapper">

                <ul class="nav">

                    @if ($user->role === 'ROLE_ADMIN')

                        <li>

                            <a href="{{ route('admin-panel') }}">Retour en panel admin</a>

                        </li>

                    @endif

                    @if ($user->role === 'ROLE_USER')

                        <li class="@if ($task == 'new-restaurant') active @endif">

                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="tim-icons icon-square-pin"></i>

                                <p>Changer d'etablissement</p>

                            </a>

                            <div class="dropdown-menu">

                                @foreach ($restaurants as $item)

                                    <a class="dropdown-item"

                                        style="@if ($item->id == $restaurant->id) font-weight:bold; @endif"

                                        href="{{ route('single', ['restau_id' => $item->id]) }}">{{ $item->name }}</a>

                                @endforeach

                                <a href="?task=new-restaurant" class="dropdown-item">

                                    <strong>-- gérer mes établissements --</strong>

                                </a>

                            </div>

                        </li>

                        <li>

                            <a href="https://monmenu.io/boutique/?autologB={{ $user->wp_token }}">

                                <i class="tim-icons icon-basket-simple"></i>

                                <p>La boutique</p>

                            </a>

                        </li>

                    @endif





                    <li class="@if ($task == 'products' || $task == 'categories') active @endif">

                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <i class="tim-icons icon-paper"></i>

                            <p>Mon menu</p>

                        </a>

                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="?task=categories">Mes catégories</a>

                            <a class="dropdown-item" href="?task=products">Mes produits</a>

                            @if ($user->role !== 'ROLE_SUBAD')

                                <a class="dropdown-item" href="?task=design">Apparence</a>

                            @endif

                            <a class="dropdown-item"

                                href="{{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}"

                                target="_blank">

                                Voir mon menu

                            </a>

                        </div>

                    </li>



                    <li class="@if ($task == 'stats') active @endif ">



                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <i class="tim-icons icon-chart-pie-36"></i>

                            <p>Statistiques</p>

                        </a>







                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="?task=stats&filter=1&show=views&allviews=1"> Nombre de

                                vues</a>

                            <a class="dropdown-item" href="?task=stats&filter=1&show=products">Statistiques produits</a>



                            <a class="dropdown-item" href="?task=stats&filter=1&show=categories">Statistiques

                                catégories</a>

                            @if ($user->role !== 'ROLE_SUBAD')

                                <a class="dropdown-item" href="?task=stats&filter=1&exportAllToPDF">Extraire en PDF</a>



                                <a class="dropdown-item" href="?task=stats&filter=1&exportAllToExcel">Extraire en

                                    excel</a>

                            @endif



                        </div>





                    </li>



                    @if ($user->role !== 'ROLE_SUBAD')

                        <li class="@if ($task == 'restaurant') active @endif">

                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fa fa-cog"></i>

                                <p>Paramètres</p>

                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item" href="?task=restaurant&show=base">Mes informations</a>

                                <a class="dropdown-item" href="?task=suggestions">Mes suggestions</a>

                                <a class="dropdown-item" href="?task=subscription">Abonnement</a>

                                <a class="dropdown-item" href="?task=orders">Mes factures</a>

                            </div>

                        </li>

                    @endif



                    {{--





                <li class="@if ($task == 'design') active @endif ">

                    <a href="?task=design">

                        <i class="tim-icons icon-palette"></i>

                        <p>Apparence</p>

                    </a>

                </li>



                <li class="@if ($task == 'subscription') active @endif ">

                    <a href="?task=subscription">

                        <i class="tim-icons icon-notes"></i>

                        <p>Abonnement</p>

                    </a>

                </li>



                <li class="@if ($task == 'orders') active @endif ">

                    <a href="?task=orders">

                        <i class="tim-icons icon-notes"></i>

                        <p>Mes factures</p>

                    </a>

                </li>









<li class="@if ($task == 'products') active @endif ">

                    <a href="?task=products">

                        <i class="tim-icons icon-heart-2"></i>

                        <p>Mes produits</p>

                    </a>

                </li>

                <li class="@if ($task == 'categories') active @endif">

                    <a href="?task=categories">

                        <i class="tim-icons icon-image-02"></i>

                        <p>Mes catégories</p>

                    </a>

                </li>

                --}}

                    {{-- <li>

                        <a href="?task=opinions">

                            <i class="tim-icons icon-bell-55"></i>

                            <p>Mes avis</p>

                        </a>

                    </li> --}}

                    <li class="">

                        <a href="logout">

                            <i class="tim-icons icon-simple-remove"></i>

                            <p>Deconnexion</p>

                        </a>

                    </li>



                </ul>

            </div>

        </div>

        <div class="main-panel">

            <!-- Navbar -->

            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">

                <div class="container-fluid">

                    <div class="navbar-wrapper">

                        <div class="navbar-toggle d-inline">

                            <button type="button" class="navbar-toggler">

                                <span class="navbar-toggler-bar bar1"></span>

                                <span class="navbar-toggler-bar bar2"></span>

                                <span class="navbar-toggler-bar bar3"></span>

                            </button>

                        </div>

                        <a class="navbar-brand" href="admin">Panneau de contrôle : <br>

                            <strong>{{ $restaurant->name }}</strong></a>

                    </div>

                </div>

            </nav>

            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog"

                aria-labelledby="searchModal" aria-hidden="true">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <input type="text" class="form-control" id="inlineFormInputGroup"

                                placeholder="SEARCH">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <i class="tim-icons icon-simple-remove"></i>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

            <!-- End Navbar -->

            <div class="content">

                <div class="row">

                    <div class="col-12">

                        @if (session('success'))

                            <div class="alert alert-success">

                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert"

                                    aria-label="Close">

                                    <i class="tim-icons icon-simple-remove"></i>

                                </button>

                                <span> {{ session('success') }}</span>

                            </div>

                        @endif

                        @if (session('error'))

                            <div class="alert alert-danger">

                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert"

                                    aria-label="Close">

                                    <i class="tim-icons icon-simple-remove"></i>

                                </button>

                                <span> {{ session('error') }}</span>

                            </div>

                        @endif

                        @if (isset($_GET['task']))

                            @php $task = $_GET['task']; @endphp

                            @include('dashboard/' . $task)

                        @else

                            <h1 style="margin-top:35px;">Bonjour {{ $user->name }}</h1>

                            <p>Depuis votre espace vous pouvez ajouter une catégorie, des sous catégories, des produits,

                                gérer vos préferences de couleurs et bien d'autres choses encore</p>

                            {{--

                            <h2 style="margin-top:35px;">La boutique MonMenu !</h2>

                            <p>Des outils qui vous permettrons d'améliorer l'experience de vos clients !</p>

                            <div class="shop-container">

                                <p class="loading-product">Chargement des produits en cours ...</p>

                                <div class="products-container">

                                </div>

                            </div> --}}

                        @endif

                    </div>

                </div>

            </div>

            <style>

                .choose {

                    display: flex;

                    align-items: center;

                    justify-content: center;

                }



                .choose-container {

                    text-align: center;

                    display: flex;

                    flex-direction: column;

                    justify-content: center;

                    align-items: center;

                    gap: 15px;

                    height: max-content;

                }



                .restaurant-list {

                    display: flex;

                    flex-wrap: wrap;

                    padding: 20px;

                    gap: 30px;

                }



                .restaurant {

                    flex: 1;

                    width: 250px;

                    max-width: 400px;

                }



                .restaurant img {

                    width: 150px;

                    height: 150px;

                    border-radius: 50%;

                    object-fit: contain;

                    object-position: center;

                }



                .shop-container {

                    width: 100%

                }



                .products-container {

                    position: relative;

                    gap: 20px;

                    justify-content: center;

                    display: none;

                }



                .product {

                    width: 250px;

                    text-align: center;

                    display: grid !important;

                    grid-template-rows: 300px 100px 50px 50px;

                    justify-content: center;

                    align-items: center;

                }



                .product figure {

                    max-width: 300px;

                    max-height: 300px;

                    margin: auto;



                }



                .product img {

                    width: 100%;

                    height: 100%;

                    object-fit: cover;

                }



                .product h3 {

                    font-size: 1rem !important;

                }



                .product h3,

                .product h4 {

                    font-weight: bold;

                }



                .product a {

                    padding: 10px 30px;

                    background-color: #ddc196;

                    color: white;

                    border-radius: 500px;

                    display: block;

                }



                .loading-product {

                    margin-top: 35px;

                }



                .slick-slide {

                    padding: 20px;

                }

            </style>

            <footer class="footer">

                <div class="container-fluid">

                    <div class="copyright">

                        © 2023 fait avec <i class="tim-icons icon-heart-2"></i> par

                        <a href="https://eurofrance-pub.com/" target="_blank">Euro France Pub</a> - créateur de

                        solution web

                    </div>

                </div>

            </footer>

        </div>

    </div>

    <!--   Core JS Files   -->

    <script src="https://monmenu.io/menus/dashboard-assets/js/core/jquery.min.js"></script>

    <script src="https://monmenu.io/menus/dashboard-assets/js/core/popper.min.js"></script>

    <script src="https://monmenu.io/menus/dashboard-assets/js/core/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>



    {{--

<script src="{{ $url }}dashboard-assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

--}}

    <script>

        function formatState(state) {

            if (!state.id) {

                return state.text;

            }

            var baseUrl = "{{ $url }}categories-icons/";



            var $state = $(

                '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '" class="img-flag" /> ' +

                state.text + '</span>'

            );

            return $state;

        };



        // $(".select-img").select2({

        //     templateResult: formatState,

        //     minimumResultsForSearch: Infinity

        // });

        $("#image").select2({

            templateResult: formatState,

            minimumResultsForSearch: Infinity

        });

        $("#image-add").select2({

            templateResult: formatState,

            minimumResultsForSearch: Infinity

        });



        // $(document).on('keyup', '#search-fake', function() {

        //     val = $(this).val();



        //     $('.select-img').select2('open');

        //     $('.select-img').select2('search', val);

        // });



        // $(document).on('keyup', '#search-fake', function() {

        //     var val = $(this).val();

        //     $('.select-img').data('select2').dropdown.$search.val(val); // Mettez à jour la valeur du champ de recherche de Select2

        //     $('.select-img').data('select2-id').search(val); // Déclenchez la recherche dans Select2

        // });

    </script>



    <script src="{{ $url }}dashboard-assets/js/plugins/chartjs.min.js"></script>

    <!--  Notifications Plugin    -->

    <script src="{{ $url }}dashboard-assets/js/plugins/bootstrap-notify.js"></script>

    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->





    <script src="{{ $url }}dashboard-assets/js/black-dashboard.js"></script>





    <script src="{{ $url }}/build/assets/leaflet.js"></script>









    @if ($task == 'stats')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

    @endif



    @if ($task == 'restaurant')

        @include('dashboard/js/restaurant')

    @endif



    @if ($task == 'orders')

        @include('dashboard/js/orders')

    @endif





    @if ($task == 'subscription')

        @include('dashboard/js/subscription')

    @endif



    <script>

        @include('dashboard/js/base')

        @if ($task == 'stats' || $task == '')

            @include('dashboard/js/stats')

        @endif

    </script>





    @if ($task == 'products')

        @include('dashboard/js/products')

    @endif



    @if ($task == 'categories')

        @include('dashboard/js/categories')

    @endif



    @if ($task == 'design')

        @include('dashboard/js/design')

    @endif



    <script>

        $(function() {

            $('[data-toggle="popover"]').popover({

                html: true

            })

        })











        $('#parent_id').on('change', function(e) {

            if ($(this).val() !== "") {

                $('.block-img, .block-content, .select-2-none').hide();

            } else {

                $('.block-img, .block-content, .select-2-none').show();

            }

        });

    </script>



    {{-- Récuperer les articles de la boutique Wordpress --}}

    {{-- <script>

        const apiUrl = "https://monmenu.io/wp-json/wc/store/v1/products";



        async function fetchData() {

            try {

                const response = await fetch(apiUrl);



                if (!response.ok) {

                    throw new Error(`Erreur lors de la requête: ${response.status} ${response.statusText}`);

                }

                const data = await response.json();

                document.querySelector('.loading-product').style.display = 'none';

                document.querySelector('.products-container').style.display = 'block';

                return data;

            } catch (error) {

                console.error("Une erreur s'est produite:", error);

            }

        }



        function formatPrice(price) {

            const formattedPrice = (price / 100).toFixed(2);

            return formattedPrice.replace('.', ',');

        }



        function createProductElement(product) {

            const productDiv = document.createElement('div');

            productDiv.classList.add('product');



            const figure = document.createElement('figure');

            const img = document.createElement('img');

            img.src = product.images[0].thumbnail;

            img.alt = "Image du produit";

            figure.appendChild(img);



            const h3 = document.createElement('h3');

            h3.textContent = product.name;



            const h4 = document.createElement('h4');

            h4.textContent = `${formatPrice(product.prices.price)} ${product.prices.currency_symbol}`;



            const link = document.createElement('a');

            link.href = product.permalink;

            link.href += '?autologB={{ $user->wp_token }}';

            link.textContent = "Lien vers le produit";



            productDiv.appendChild(figure);

            productDiv.appendChild(h3);

            productDiv.appendChild(h4);

            productDiv.appendChild(link);



            return productDiv;

        }



        fetchData()

            .then(data => {

                const productsContainer = document.querySelector('.products-container');



                data.forEach(product => {

                    if (product.slug !== 'abonnement-monmenu') {

                        const productElement = createProductElement(product);

                        productsContainer.appendChild(productElement);

                    }

                });

                $('.products-container').slick({

                    infinite: true,

                    slidesToShow: 3,

                    slidesToScroll: 3,

                    dots: true,

                    autoplay: true,

                    autoplaySpeed: 2000,

                    responsive: [{

                            breakpoint: 1024,

                            settings: {

                                slidesToShow: 4,

                                slidesToScroll: 4,

                            }

                        },

                        {

                            breakpoint: 600,

                            settings: {

                                slidesToShow: 3,

                                slidesToScroll: 3

                            }

                        },

                        {

                            breakpoint: 480,

                            settings: {

                                slidesToShow: 2,

                                slidesToScroll: 2

                            }

                        }

                    ]

                });

            });

        const apiUrlPlaque = "https://maplaque-nfc.fr/wp-json/wc/store/v1/products?per_page=50";



        async function fetchDataPlaque() {

            try {

                const responsePlaque = await fetch(apiUrlPlaque);



                if (!responsePlaque.ok) {

                    throw new Error(`Erreur lors de la requête: ${responsePlaque.status} ${responsePlaque.statusText}`);

                }

                const dataPlaque = await responsePlaque.json();

                document.querySelector('.loading-product').style.display = 'none';

                return dataPlaque;

            } catch (error) {

                console.error("Une erreur s'est produite:", error);

            }

        }



        function formatPricePlaque(price) {

            const formattedPricePlaque = (price / 100).toFixed(2);

            return formattedPricePlaque.replace('.', ',');

        }



        function createProductElementPlaque(product) {

            const productDivPlaque = document.createElement('div');

            productDivPlaque.classList.add('product');



            const figurePlaque = document.createElement('figure');

            const imgPlaque = document.createElement('img');

            imgPlaque.src = product.images[0].thumbnail;

            imgPlaque.alt = "Image du produit";

            figurePlaque.appendChild(imgPlaque);



            const h3Plaque = document.createElement('h3');

            h3Plaque.textContent = product.name;



            const h4Plaque = document.createElement('h4');

            h4Plaque.textContent = `${formatPricePlaque(product.prices.price)} ${product.prices.currency_symbol}`;



            const linkPlaque = document.createElement('a');

            linkPlaque.href = product.permalink;

            linkPlaque.textContent = "Lien vers le produit";



            productDivPlaque.appendChild(figurePlaque);

            productDivPlaque.appendChild(h3Plaque);

            productDivPlaque.appendChild(h4Plaque);

            productDivPlaque.appendChild(linkPlaque);



            return productDivPlaque;

        }



        fetchDataPlaque()

            .then(data => {

                const productsContainerPlaque = document.querySelector('.products-container');



                data.forEach(product => {

                    if (product.id === 4714 || product.id === 4711 || product.id === 1540 || product.id ===

                        947) {

                        const productElementPlaque = createProductElementPlaque(product);

                        productsContainerPlaque.appendChild(productElementPlaque);

                    }

                });

            });

    </script> --}}



</body>



</html>

