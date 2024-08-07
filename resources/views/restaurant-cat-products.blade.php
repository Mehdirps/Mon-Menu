<?php
$url = config('app.url');
?>


@extends('layouts.app')


@section('content')
<section class="restaurant page-cats">

    <header class="restaurant-header"> <!-- header -->
        @include('partial.restaurant-name')
    </header> <!-- header -->

    <section class="restaurant-products"> <!-- resto products -->

        <figure class="category-banner">
            @if ($mainCategory->image)
            <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $mainCategory->image }}"
            alt="Image de la categorie {{ $mainCategory->name }}">
            @else
            <img src="{{ $url }}images/default.png" alt="Image par default">
            @endif
        </figure>

        <h2 class="title-point sub-title">{{ $mainCategory->name }}</h2>

        <div class="restaurant-desc"> <!-- desc -->
            <p class="cat-content">{{ $mainCategory->content }}</p>
        </div> <!-- desc -->

        <div class="resto_cats resto_cat_in_cat"> <!-- cats -->
            @foreach ($allCategories as $category)
            <div class="resto_cat {{ $category->id === $mainCategory->id ? 'active' : '' }} ">
               <a class="full-link" href="{{ route('restaurant-products', [Str::slug($restaurant->name),$restaurant->id, $category->id]) }}"></a>
               <div class="resto_cat_img" style="background-image: url(@if ($category->image){{ $url }}images/{{ $restaurant->id }}/{{ $category->image }}@else{{ $url }}images/default.png);@endif" ></div>
               <h4 class="resto_cat_title">{{ $category->name }}</h4>
           </div><!-- /.resto-cat -->
           @endforeach
       </div> <!-- cats -->

       <div id="loader" style="display: none;"><div class="loader-icon"></div></div>

       <div id="cible">
           <div class="sub_categories">
            @foreach ($subCategories as $subCategory)
            <div class="sub_category {{ $subCategory->id }}">
                <a href="#h3-{{ $subCategory->id }}"
                    class="subCategory_link {{ $subCategory->id }}">{{ $subCategory->name }}</a>
                </div>
                @endforeach
            </div>

            <div class="products"> <!-- products -->

                <div id="{{ $mainCategory->id }}" class="products-container"> <!-- products container -->
                    @if (!$productsCatList) <!-- if cat list -->
                        <p class="no-prods">Aucun produits pour le moment</p>
                    @else
                        @foreach ($productsCatList as $product) <!-- catlist -->
                            @if ($product->active) <!-- product active -->
                                @if ($mainCategory->id === $product->category) <!-- $mainCategory->id === $product->category -->
                                    <div class="product" id="prod-{{ $product->id }}"> <!-- products -->
                                        <div class="product-infos"> <!-- infos -->
                                            <h5>{{ $product->name }}</h5>
                                            <p class="product-content">{{ Illuminate\Support\Str::limit($product->content, 75) }}</p>
                                            <p>{{ $product->price }} €</p>
                                            <p data-id="{{ $product->id }}" class="open-details">En savoir plus</p>
                                        </div> <!-- infos -->
                                        <figure class="product-image open-details" data-id="{{ $product->id }}">
                                            @if ($product->image)
                                            <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}">
                                            @else
                                            <img src="{{ $url }}images/default.png">
                                            @endif
                                        </figure>
                                    </div> <!-- products -->

                                    <div class="product-details-container" id="product-{{ $product->id }}"> <!-- container -->
                                        <div class="product-details"> <!-- deatils -->
                                            <figure class="product-details-image">
                                                @if ($product->image)
                                                <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}"
                                                alt="Image de la categorie {{ $product->name }}">
                                                @else
                                                <img src="{{ $url }}images/default.png" alt="Image par default">
                                                @endif
                                            </figure>
                                            <div class="products-details-infos">
                                                <h5>{{ $product->name }}</h5>
                                                <p class="product-details-content">{{ $product->content }}
                                                </p>
                                                @if ($product->allergenes)
                                                <h5>Allergènes</h5>
                                                <p class="product-details-content">{{ $product->allergenes }}
                                                    @endif
                                                </p>
                                            </div>
                                            <svg class="close-details" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill="currentColor"
                                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93A10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34A8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83l-1.41 1.41L10 11.41l-2.83 2.83l-1.41-1.41L8.59 10L5.76 7.17l1.41-1.41L10 8.59l2.83-2.83l1.41 1.41z" />
                                            </svg>
                                        </div> <!-- deatils -->
                                    </div> <!-- container -->
                                @endif<!-- $mainCategory->id === $product->category -->
                            @endif <!-- active -->
                        @endforeach <!-- catlist -->
                    @endif <!-- if cat list -->
                </div> <!-- container -->
            </div><!-- products -->



            <div class="products products-subCategories">
            @foreach ($subCategories as $subCategory) <!-- subCategories -->
                <div class="products-container"> <!-- products-container -->
                    <div id="{{ $subCategory->id }}" class="prod-cont"><!-- prod-cont -->
                        <h3 id="h3-{{ $subCategory->id }}">{{ $subCategory->name }}</h3>
                        @if (!$productsCatList) <!-- !$productsCatList -->
                            <p class="no-prods">Aucun produits pour le moment</p>
                        @else
                            @foreach ($productsCatList as $product) <!-- $productsCatList -->
                                @if ($subCategory->id === $product->subCategory) <!-- $subCategory->id === $product->subCategory -->
                                    <div class="product"> <!-- product -->
                                        <div class="product-infos"> <!-- product-infos -->
                                            <h5>{{ $product->name }}</h5>
                                            <p class="product-content">{{ Illuminate\Support\Str::limit($product->content, 75) }}</p>
                                            <p>{{ $product->price }} €</p>
                                            <p data-id="{{ $product->id }}" class="open-details">En savoir plus</p>
                                        </div> <!-- product-infos -->
                                        <figure class="product-image open-details" data-id="{{ $product->id }}">
                                        <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}">
                                        </figure>
                                    </div> <!-- product -->
                        <div class="product-details-container" id="product-{{ $product->id }}">
                            <div class="product-details">
                                <figure class="product-details-image">
                                    <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}">
                                </figure>
                                <div class="products-details-infos">
                                    <h5>{{ $product->name }}</h5>
                                    <p class="product-details-content">{{ $product->content }}
                                    </p>
                                </div>
                                <svg class="close-details" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path fill="currentColor"
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93A10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34A8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83l-1.41 1.41L10 11.41l-2.83 2.83l-1.41-1.41L8.59 10L5.76 7.17l1.41-1.41L10 8.59l2.83-2.83l1.41 1.41z" />
                            </svg>
                        </div>
                                </div>
                            @endif <!-- $subCategory->id === $product->subCategory -->
                        @endforeach <!-- $productsCatList -->
                    @endif <!-- !$productsCatList -->
                </div><!-- prod-cont -->
            </div> <!-- products-container -->
            @endforeach <!-- subCategories -->
        </div><!-- products -->

        </div><!-- /#cible -->
    </section> <!-- resto products -->
</section>
@include('partial.restaurant-footer')
@endsection

@section('footer-js')



<script>
    $('.resto_cat a').click(function(event) {
        $('#cible').removeClass('arrive');
        $('#cible').addClass('part');
        event.preventDefault();

        href = $(this).attr('href');
        parent = $(this).parent();

        /* changement du header */
        backgroundImage = parent.find('.resto_cat_img').css('background-image');

        title = parent.find('.resto_cat_title').text();

        imageUrl = backgroundImage.replace(/^url\(['"](.+)['"]\)/, '$1');
        $('.category-banner img').attr('src', imageUrl );

        $('.sub-title').text(title);

        /* */

        $('.resto_cat').removeClass('active');
        parent.addClass('active');

        $('#loader').show();
        $.ajax({
            url: href,
            method: 'GET',
            success: function(response) {
             content = $(response).find('#cible').html();
             restaurantdesc = $(response).find('.restaurant-desc').html();
            $('#cible').html(content);
            $('.restaurant-desc').html(restaurantdesc);
        },
        error: function() {
            $('#cible').html('...');
        },
        complete: function() {
            $('#loader').hide();
            $('#cible').removeClass('part');
            $('#cible').addClass('arrive');
            setTimeout(function() {
                $('#cible').removeClass('arrive');
            }, 500);
        }
    });
    });

    var csrfToken = '{{ csrf_token() }}';

$(document).on('click', '.open-details', function() {
    var productId = $(this).data('id');
    var details = $(`#product-${productId}`);
    details.toggleClass('open');

    // Requête AJAX pour augmenter le nombre de vues
    $.ajax({
        url: '../../add-view/' + productId,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
            console.log('Nombre de vues augmenté !');
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de l\'augmentation du nombre de vues :', error);
        }
    });
});



    $(document).on('click', '.product-details-container', function() {
        $(this).removeClass('open');
    });






</script>




    @endsection
