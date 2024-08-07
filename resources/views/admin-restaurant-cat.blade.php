 <?php
 $url = config('app.url');
 $viewName = array_keys(
     view()
         ->getFinder()
         ->getViews(),
 )[0];
 ?>
 @extends('layouts.app')
 @section('content')
     <link rel="stylesheet" href="../../../build/assets/app.css">

     <style>
         .container.nav_head .logo {
             max-width: 100px;
         }
     </style>

     @if (auth()->check())
         @if ($user->id== $restaurant->admin_id)
             @include('partial.crud.update-infos')
             <span class="superplus">
                 <span>
                     <svg fill="none" height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                         <g clip-rule="evenodd" fill="rgb(0,0,0)" fill-rule="evenodd">
                             <path
                                 d="m1.25 12c0-5.93706 4.81294-10.75 10.75-10.75 5.9371 0 10.75 4.81294 10.75 10.75 0 5.9371-4.8129 10.75-10.75 10.75-5.93706 0-10.75-4.8129-10.75-10.75zm10.75-9.25c-5.10864 0-9.25 4.14136-9.25 9.25 0 5.1086 4.14136 9.25 9.25 9.25 5.1086 0 9.25-4.1414 9.25-9.25 0-5.10864-4.1414-9.25-9.25-9.25z" />
                             <path
                                 d="m12 7.25c.4142 0 .75.33579.75.75v8c0 .4142-.3358.75-.75.75s-.75-.3358-.75-.75v-8c0-.41421.3358-.75.75-.75z" />
                             <path
                                 d="m7.25 12c0-.4142.33579-.75.75-.75h8c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-8c-.41421 0-.75-.3358-.75-.75z" />
                         </g>
                     </svg>
                 </span>
             </span>
             <!-- /.superplus -->
         @endif
     @endif

     <div class="container-fluid pt-0 mt-0">
         <div class="row">
             <div class="col-4 col-sm-3 sidebar">
                 <div class="wrap_logo">
                     <a class="navbar-brand" href="{{ route('single') }}">
                         @if ($restaurant)
                             <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->logo }}"
                                 alt="Logo du restaurant {{ $restaurant->name }}">
                         @endif
                     </a>

                     @if (auth()->check())
                         @if ($user->id== $restaurant->admin_id)
                             <a href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_logo"
                                 id="updateresto" class="updateresto">
                                 <i class="fa fa-edit"></i> Modifier les infos
                             </a>
                         @endif
                     @endif
                 </div>

                 <div class="col-12">
                     <a href="#" class="reduire" id="reduire">Réduire le menu</a>
                 </div>

                 @foreach ($mainCategories as $category)
                     <?php $class = $currentCategory->id === $category->id ? 'active' : ''; ?>
                     {{-- @if ($category) --}}



                     <div class="col col-categorie {{ $class }}">

                         <div class="card">
                             <!-- card -->

                             <div class="wrap_img_prod">



                                 <!-- lien -->
                                 <a href="{{ route('singlecat', [$restaurant->id, $category->id, $category->slug]) }}">
                                     @if ($category->image)
                                         <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $category->image }}"
                                             alt="Image de la categorie {{ $category->name }}">
                                     @else
                                         <img src="{{ $url }}images/default.png" alt="Image par default">
                                     @endif
                                     <span class="curved-container">
                                         <h4>{{ $category->name }}</h4>
                                     </span>
                                 </a>



                             </div>
                         </div> <!-- card -->
                     </div> <!-- col-categorie -->

                     @if (auth()->check())
                         @if ($user->id== $restaurant->admin_id)
                             @include('partial.crud.add-category', [
                                 'category' => $category,
                                 'class' => $class,
                                 'main' => 1,
                             ])
                         @endif
                     @endif



                     {{-- @endif --}}
                 @endforeach




             </div>




             <div class="col-sm-9 col-8 main">
                 <div class="row">

                     <div class="col-12 wrap_img_cat">
                         <span class="noise"></span>

                         <div class="wrap_img_cat_bg"
                             style="background-image: url({{ asset('images/' . $currentCategory->image) }});">

                         </div>
                         @if ($currentCategory->image)
                             <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $currentCategory->image }}"
                                 alt="Image de la categorie {{ $currentCategory->name }}">
                         @else
                             <img src="{{ $url }}images/default.png" alt="Image par default">
                         @endif

                     </div>



                     <h1 class="cat_name text-uppercase">{{-- Accueil / --}}
                         ••• {{ $currentCategory->name }} ••• </h1>



                     <div class="rows">
                         <div class="main_category row">
                             <!-- main_product -->


                             @if (isset($categories) && $categories)
                                 <?php $i = 0; ?>
                                 @foreach ($categories as $categorie)
                                     @if ($categorie)
                                         @include('partial.category', [
                                             'category' => $categorie,
                                             'class' => $class,
                                         ])
                                     @endif

                                     <?php $i++; ?>
                                 @endforeach
                             @endif

                             @include('partial.crud.add-category', [
                                 'category' => $category,
                                 'class' => $class,
                                 'main' => 0,
                             ])

                         </div>

                         <div class="main_product row">
                             <!-- main_product -->
                             @foreach ($products->sortBy('display_order') as $product)
                                 <div
                                     class="product col-6 col-sm-6 col-md-4 py-4 @if ($loop->even)  @endif">
                                     <!-- product -->
                                     <div class="row">
                                         <!-- row -->
                                         <div class="col-6" style="margin:auto;">
                                             <!-- col -->
                                             <div class="wrap_img">
                                                 <!-- wrap_img -->
                                                 <a href="#" data-bs-toggle="modal"
                                                     data-bs-target="#modal_produit_{{ $product->id }}">
                                                     @if ($product->image)
                                                         <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}"
                                                             alt="Image de la categorie {{ $product->name }}">
                                                     @else
                                                         <img src="{{ $url }}images/default.png"
                                                             alt="Image par default">
                                                     @endif
                                                 </a>
                                             </div> <!-- wrap_img -->
                                         </div> <!-- col -->
                                         <div class="col-12 text-center">
                                             <!-- col -->
                                             <h5 class="mt-3">{{ $product->name }}</h5>
                                             <h2><span></span>{{ $product->price }} €<span></span></h2>
                                         </div> <!-- col -->
                                         <div class="col-12 align-self-center">
                                             <!-- col -->



                                             @if (auth()->check())
                                                 @if ($user->restaurant_id === $category->restaurant_id)
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
                                                                 onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}' )">
                                                                 <i class="fa fa-trash"></i> Supprimer
                                                             </button>
                                                         </small>
                                                     </form>

                                                     <script>
                                                         function confirmDelete(categoryId, categoryName) {
                                                             if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ( " + categoryName + "    " + categoryId +
                                                                     "  ) ?")) {
                                                                 document.getElementById('delete-form-' + categoryId).submit();
                                                             }
                                                         }
                                                     </script>

                                                     @include('partial.crud.update-product')
                                                 @endif
                                             @endif




                                             <div class="modal fade" id="modal_produit_{{ $product->id }}" tabindex="-1"
                                                 aria-labelledby="" aria-hidden="true">
                                                 <div class="modal-dialog">
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <h5 class="modal-title">{{ $product->name }}</h5>
                                                             <button type="button" class="btn-close"
                                                                 data-bs-dismiss="modal" aria-label="Close"></button>
                                                         </div>
                                                         <div class="modal-body">
                                                             <img class="w-100"
                                                                 src="{{ asset('images/products/' . $product->image) }}"
                                                                 alt="...">

                                                             <p class="mt-3">{{ $product->content }}</p>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <!-- footer -->


                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>






                                         </div> <!-- col -->
                                     </div> <!-- row -->
                                 </div> <!-- product -->
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


 @if (auth()->check())
     @if ($user->id== $restaurant->admin_id)

         @section('footer-js')
             <script>
                 $(document).ready(function() {



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
         @endsection

     @endif
 @endif
