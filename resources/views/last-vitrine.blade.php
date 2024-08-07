 <?php $url = config('app.url'); ?>
 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MonMenu.io</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mrs+Saint+Delafield&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="{{$url}}build/assets/vitrine.css">


</head>
<body class="antialiased">
    <div class="container">
        <div class="row mt-2 align-items-center justify-content-center">
            <div class="col-5 align-self-center ">
                <img class="logo" src="{{$url}}img/logo-4.svg" alt="" style="width: 189px;">
            </div>
            <!-- /.col-7 -->
            <div class="col-7 align-self-center " style="display: flex;align-items: center;justify-content: flex-end;">

                <a href="https://www.facebook.com/profile.php?id=100093636714220" class="" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="17" height="17" viewBox="0 0 17 17">
                        <g>
                        </g>
                        <path d="M12.461 5.57l-0.309 2.93h-2.342v8.5h-3.518v-8.5h-1.753v-2.93h1.753v-1.764c0-2.383 0.991-3.806 3.808-3.806h2.341v2.93h-1.465c-1.093 0-1.166 0.413-1.166 1.176v1.464h2.651z" fill="#d3a868"/>
                    </svg>
                </a>
                <a href="https://instagram.com/monmenu.io?igshid=MzRlODBiNWFlZA==" class="ml-2" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="17" height="17" viewBox="0 0 17 17">
                        <g>
                        </g>
                        <path d="M13 0h-9c-2.2 0-4 1.8-4 4v9c0 2.2 1.8 4 4 4h9c2.2 0 4-1.8 4-4v-9c0-2.2-1.8-4-4-4zM16 13c0 1.654-1.346 3-3 3h-9c-1.654 0-3-1.346-3-3v-6h3.207c-0.286 0.61-0.457 1.283-0.457 2 0 2.619 2.131 4.75 4.75 4.75s4.75-2.131 4.75-4.75c0-0.717-0.171-1.39-0.457-2h3.207v6zM12.25 9c0 2.068-1.682 3.75-3.75 3.75s-3.75-1.682-3.75-3.75 1.682-3.75 3.75-3.75 3.75 1.682 3.75 3.75zM12.152 6c-0.872-1.059-2.176-1.75-3.652-1.75s-2.78 0.691-3.652 1.75h-3.848v-2c0-1.654 1.346-3 3-3h9c1.654 0 3 1.346 3 3v2h-3.848zM14.454 2.722v1.298c0 0.299-0.244 0.543-0.542 0.543h-1.368c-0.3-0.001-0.544-0.245-0.544-0.543v-1.298c0-0.299 0.244-0.543 0.544-0.543h1.368c0.298 0 0.542 0.244 0.542 0.543z" fill="#d3a868"/>
                    </svg>
                </a>

                <a href="{{route('login')}}" class="btn btn-primary btn-log ml-2">Espace restaurateur</a>
            </div>
            <!-- /.col-5 -->
        </div>
        <!-- /.row -->


    </div>
    <!-- /.container -->
    <main class="main">
        <div class="container">
         <div class="row">
             <div class="col-md-7">
                <h1>Maîtrisez <span>Votre Carte !</span></h1>
                <p><strong>Gérez votre menu avec facilité et puissance !</strong></p>
                <p>
                    Bienvenue sur MonMenu.io, l'outil de gestion de menu ultime pour les restaurateurs modernes. Simplifiez la gestion de votre menu avec notre interface intuitive et performante. Que vous soyez un petit café branché ou un restaurant étoilé, MonMenu.io vous offre les fonctionnalités puissantes dont vous avez besoin pour gérer efficacement votre offre culinaire.
                </p>
                <p>
                    Mettez à jour vos plats, ajoutez de nouvelles créations, ajustez les prix et affichez les informations essentielles en un rien de temps. Libérez-vous des tracas administratifs et concentrez-vous sur l'essentiel : offrir une expérience gastronomique exceptionnelle à vos clients.
                </p>


                <a href="{{route('register')}}" class="btn btn-primary">Ça m'intéresse</a>
                <!-- /.btn btn-primary -->
            </div>
            <!-- /.col-6 -->
            <div class="col-md-5">


                <img class="app-img" src="{{$url}}img/ezgif-4-3470040e05.gif" alt="">


            </div>
            <!-- /.col-5 -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <section class="avantages">
     <div class="container">
        <div class="row text-center">
            <div class="col-12 text-center">
                <h3>Optimisez la gestion<br>de votre menu</h3>
                <p>
                    Dites adieu aux menus papier et découvrez MonMenu.io, une solution économique, performante et facile d'utilisation. Fini les frais d'impression et de réimpression des menus traditionnels. Grâce à notre interface numérique, mettez à jour votre menu instantanément. Gérez efficacement votre offre culinaire, ajoutez de nouveaux plats, ajustez les prix et mettez en valeur les spéciaux du jour en quelques clics seulement. Avec une navigation intuitive et conviviale, MonMenu.io simplifie votre gestion tout en vous permettant de vous concentrer sur la création de plats délicieux. Optez pour une solution moderne qui économise du temps et de l'argent, tout en offrant à vos clients une expérience gastronomique exceptionnelle.
                </p>
            </div>
            <!-- /.col-12 text-center -->
            <div class="col-6 col-md-3">
                <img class="img-avantage" src="{{$url}}img/002-menu.svg">
                <p><strong>Fini les menus papier</strong></p>
                <p><small>Optez pour le numérique et simplifiez la gestion de votre menu.</small></p>
            </div>
            <!-- /.col-6 -->
            <div class="col-6 col-md-3">
                <img class="img-avantage" src="{{$url}}img/004-des-economies.svg">
                <p><strong>Economique</strong></p>
                <p><small>Réduisez vos coûts avec une solution numérique abordable.</small></p>
            </div>
            <!-- /.col-6 -->
            <div class="col-6 col-md-3">
                <img class="img-avantage" src="{{$url}}img/001-reference.svg">
                <p><strong>Performant</strong></p>
                <p><small>Gérez votre menu avec puissance et efficacité.</small></p>
            </div>
            <!-- /.col-6 -->
            <div class="col-6 col-md-3">
                <img class="img-avantage" src="{{$url}}img/005-claquement-de-doigt.svg">
                <p><strong>Facile d'utilisation</strong></p>
                <p><small>Simplifiez votre gestion de menu avec une interface conviviale.</small></p>
            </div>
            <!-- /.col-6 -->


            <div class="col-12">
                <a href="elevens-burger/2" class="btn btn-primary" target="_blank">Voir un menu exemple </a>
                <!-- /.btn btn-primary -->

                <hr>
            </div>
            <!-- /.col-12 -->


<!-- /.col-6 -->
<div class="col-12 order-1 col-md-6 col-restaurateur align-self-center ">
    <p class="mt-4"><strong>Lorem Ipsum</strong></p>
    <p>
        Profitez dès maintenant de notre offre sans engagement, sans contrat et avec 14 jours d'essai gratuit, sans nécessité de fournir de carte bancaire.
        <br>
        Essayez-le dès aujourd'hui et découvrez la différence !
    </p>
</div>
<!-- /.col-6 -->

<div class="col-12 order-2 col-md-6 col-restaurateur align-self-end">
    <img class="restaurateur-img" src="{{$url}}img/restaurateur.svg" alt="">
</div>



<div class="col-6 order-4 order-md-3 align-self-center">
    <img src="{{$url}}img/application-resto.svg">
</div>
<!-- /.col-6 -->
<div class="col-6 order-3 order-md-4 align-self-center text-right text-md-left">
        <p class="mt-4"><strong>Lorem Ipsum</strong></p>
    <p>
        Lorem ipsum dolor sit, amet consectetur adipisicing, elit.
    </p>
</div>
<!-- /.col-6 -->





<!-- /.col-6 -->
<div class="col-6 order-6 order-md-5 align-self-center text-left text-md-right ">
    <p class="mt-4"><strong>Lorem Ipsum</strong></p>
     <p>
        Lorem ipsum dolor sit, amet consectetur adipisicing, elit.
    </p>
</div>
<!-- /.col-6 -->

<div class="col-6 order-5 order-md-6 align-self-center">
    <img class="restaurateur-img" src="{{$url}}img/serveur.svg" alt="">
</div>


        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /.avantages -->



<section class="section_faq pt-4 pb-4">



<div class="container">
  <h2>FAQ</h2>
  <div class="accordion">
    <div class="accordion-item">
      <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">Lorem Ipsum</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
    <div class="accordion-item">
      <button id="accordion-button-2" aria-expanded="false"><span class="accordion-title">Lorem Ipsum</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
    <div class="accordion-item">
      <button id="accordion-button-3" aria-expanded="false"><span class="accordion-title">Lorem Ipsum</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
    <div class="accordion-item">
      <button id="accordion-button-4" aria-expanded="false"><span class="accordion-title">Lorem Ipsum</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>
    <div class="accordion-item">
      <button id="accordion-button-5" aria-expanded="false"><span class="accordion-title">Lorem Ipsum</span><span class="icon" aria-hidden="true"></span></button>
      <div class="accordion-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra suspendisse potenti.</p>
      </div>
    </div>


    <div class="col-12 mt-5">
         <a href="{{route('register')}}" class="btn btn-primary" target="_blank">Commencer des maintenant ! </a>
                <!-- /.btn btn-primary -->
    </div>
    <!-- /.col-12 -->

  </div>
</div>

</section>
<!-- /.section_faq -->


<section class="sections_all_restos pb-4">
    <div class="container">
        <div class="row pt-3 ">
            <div class="col-12"><h4>Les restaurants inscrits sur MonMenu.io</h4></div>
            <!-- /.col-12 -->
        </div>
        <!-- /.row -->

        <div class="">
               <div id="map"></div>
               <!-- /#map -->
            </div>
    </div>
    <!-- /.container -->
</section>
<!-- /.sections_all_restos -->


<section class="section_footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="{{$url}}img/logo-4.svg" style="width: 100px;">
                <p>MonMenu.io, votre solution de gestion de menu de confiance. En simplifiant vos opérations quotidiennes, nous libérons votre créativité culinaire et vous permettons de vous concentrer sur l'essentiel : offrir une expérience gastronomique exceptionnelle à vos clients.
                </p>
                <p>
                    Avec MonMenu.io, la gestion de votre menu devient un jeu d'enfant. Mettez à jour votre carte instantanément, personnalisez vos plats, ajustez les prix et affichez les informations essentielles en quelques clics. Notre interface intuitive et conviviale facilite la navigation, vous permettant ainsi de maîtriser tous les aspects de votre menu avec aisance.
                    <p>
                        <p>
                            Nous sommes fiers de proposer une solution flexible et adaptée à vos besoins spécifiques. Que vous dirigiez un café branché, un restaurant gastronomique ou toute autre entreprise de restauration, MonMenu.io s'adapte à vous. Maximisez votre productivité, optimisez vos coûts et offrez à vos clients une expérience inoubliable en tirant parti de notre puissant outil de gestion de menu.
                        </p>
                        <a href="{{route('register')}}">Rejoignez la communauté grandissante des restaurateurs</a> qui ont choisi MonMenu.io comme partenaire privilégié pour leur succès. Simplifiez votre gestion, libérez votre créativité et atteignez de nouveaux sommets gastronomiques grâce à notre solution de pointe.
                    </p>

                </div>
                <div class="col-12 text-center copy">
                    Copyright © 2023 - Monmenu.io - Tous les droits sont réservés<br>Création de site internet maplaque-nfc.fr
                </div>
                <!-- /.col-12 text-center -->
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
    </section>
    <!-- /.section_footer -->
</main>
<script src="{{$url}}/build/assets/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js"></script>

<script>


const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');

  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }

  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));


  var startlat = 46.31658418;
  var startlon = 2.46093750;
  var options = {
    center: [startlat, startlon],
    zoom: 5
  };

  var map = L.map('map', options);
  var greenIcon = L.icon({
    iconUrl: '{{$url}}build/assets/img/star-1.png',
    iconSize: [50, 50],
    iconAnchor: [50, 50],
    popupAnchor: [-25, -25]
  });

  L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'OSM' }).addTo(map);

  // Créez un groupe de marqueurs (marker cluster)
  var markers = L.markerClusterGroup();

  var restaurants = {!! json_encode($restaurants) !!}; // Récupérer les restaurants depuis le contrôleur Laravel

  restaurants.forEach(function(restaurant) {
    if (restaurant.lat) {
         var marker = L.marker([restaurant.lat, restaurant.lon], { icon: greenIcon });
if(restaurant.logo){
    marker.bindPopup( '<a href="restaurant-'+restaurant.id+'">\
        <img src="images/restaurants/'+restaurant.logo+'"><hr>'+ restaurant.name + '</a>');
}else{
    marker.bindPopup('<a href="restaurant-'+restaurant.id+'">\
        '+ restaurant.name + '</a>');
}

    markers.addLayer(marker);
    }


  });

  map.addLayer(markers); // Ajoutez le groupe de marqueurs à la carte
</script>



</body>
</html>
