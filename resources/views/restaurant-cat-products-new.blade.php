<?php
$url = config('app.url');
?>


@extends('layouts.app')


@section('content')
    <section class="restaurant page-cats">
        <section class="restaurant-products"> <!-- resto products -->







            <div id="loader" style="display: none;">
                <div class="loader-icon"></div>
            </div>

            <div id="cible">


                <script async src="https://www.googletagmanager.com/gtag/js?id=G-9Z9VHBG5H0"></script>

                <script>
                    window.dataLayer = window.dataLayer || [];

                    function gtag() {
                        dataLayer.push(arguments);
                    }
                    gtag('js', new Date());

                    gtag('config', 'G-9Z9VHBG5H0');
                </script>


                <div class="new_resto_container"
                    style="margin-left: auto;margin-right: auto; margin-top:-10px;width: 100%;max-width: 1200px;background-color: #fff;padding: 16px;overflow-x: hidden;overflow-y: auto;min-height: 100vh;position: fixed;left: 0;right: 0;top: 0;bottom: 0;">

                    <div class="menu_title">
                        <h1 class="">
                            <span class="remove_slide_cats">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </span>
                            <!-- /.remove_slide_cats -->
                            {{ $mainCategory->name }}
                        </h1>
                    </div>

                    <div class="restaurant-desc"> <!-- desc -->
                        <p class="cat-content">{{ $mainCategory->content }}</p>
                    </div> <!-- desc -->



                    <nav class="selector_menu_section" style="top: -20px;">
                        <ul class="selector_menu" style="max-width: 90vw;">
                            @foreach ($subCategories as $subCategory)
                                <li data-id="#cats_{{ $subCategory->id }}">
                                    <a href="#cats_{{ $subCategory->id }}">{{ $subCategory->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>






                    <div class="products"> <!-- products -->
                        <div id="{{ $mainCategory->id }}" class="products-container"> <!-- products container -->
                            @if (!$productsCatList)
                                <!-- if cat list -->
                                <p class="no-prods">Aucun produits pour le moment</p>
                            @else
                                @php
                                    // Convertir le tableau $productsCatList en une collection Laravel
                                    $productsCatList = collect($productsCatList);
                                @endphp

                                @foreach ($productsCatList->sortBy('display_order') as $product)
                                    <!-- catlist -->
                                    @if ($product->active)
                                        <!-- product active -->
                                        @if ($mainCategory->id === $product->category)
                                            <!-- $mainCategory->id === $product->category -->
                                            <div class="product"
                                                data-id="{{ route('showOne', [$product->id, $restaurant->id]) }}"
                                                id="prod-{{ $product->id }}"> <!-- products -->
                                                <div class="product-infos"> <!-- infos -->
                                                    <div class="prod-infos"
                                                        data-id="{{ route('showOne', [$product->id, $restaurant->id]) }}"
                                                        id="prod-{{ $product->id }}">
                                                        <h5>{{ $product->name }}</h5>
                                                        <p class="product-content">
                                                            {{ Illuminate\Support\Str::limit($product->content, 75) }}</p>

                                                        @if ($product->appellations && $product->appellations !== 'null')
                                                            <div class="appellations">
                                                                @foreach (json_decode($product->appellations) as $item)
                                                                    <img style="height:20px"
                                                                        src="{{ $url }}/images/appellations/{{ $item }}.png"
                                                                        alt="Icon {{ $item }}">
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        <div class="open-details-actions">
                                                            <p>{{ $product->price }} €</p>
                                                        </div>
                                                    </div>
                                                    @if ($restaurant->cart)
                                                        <div class="btn btn-primary addToCart"
                                                            onclick="
                                                    const productName = this.getAttribute('data-productName');
                                                    const restauId = this.getAttribute('data-restau_id');
                                                    const quantity = 1;
                                                    const price = parseFloat(this.getAttribute('data-price')); // Convertir le prix en nombre à virgule flottante
                                                    let cart = JSON.parse(sessionStorage.getItem(`cart${restauId}`)) || [];

                                                    const existingProductIndex = cart.findIndex(item => item.productName === productName);

                                                    if (existingProductIndex !== -1) {
                                                        alert(`Le produit a déjà été ajouté au panier, si vous souhaitez modifier la quantité faites le dans le panier.`)
                                                        return;
                                                    } else {
                                                        cart.push({ productName, quantity, price: price * quantity });
                                                    }
                                                
                                                    sessionStorage.setItem(`cart${restauId}`, JSON.stringify(cart));
                                                    afficherPanier()
                                                    alert(`Produit ajouté au panier avec succès ${productName}`)
                                                    "
                                                            data-productName="{{ $product->name }}"
                                                            data-price="{{ $product->price }}"
                                                            data-restau_id="{{ $restaurant->id }}">Ajouter un panier</div>
                                                    @endif
                                                </div> <!-- infos -->
                                                <figure class="product-image prod-infos"
                                                    data-id="{{ route('showOne', [$product->id, $restaurant->id]) }}">
                                                    @if ($product->image)
                                                        <img
                                                            src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}">
                                                    @endif
                                                </figure>
                                            </div> <!-- products -->
                                        @endif
                                        <!-- $mainCategory->id === $product->category -->
                                    @endif <!-- active -->
                                @endforeach <!-- catlist -->
                            @endif <!-- if cat list -->
                        </div> <!-- container -->
                    </div><!-- products -->



                    <div class="products products-subCategories">
                        @foreach ($subCategories as $subCategory)
                            <!-- subCategories -->
                            <div class="products-container"> <!-- products-container -->
                                <div id="cats_{{ $subCategory->id }}" class="prod-cont"><!-- prod-cont -->
                                    <h3 id="h3-{{ $subCategory->id }}">{{ $subCategory->name }}</h3>
                                    @if (!$productsCatList)
                                        <!-- !$productsCatList -->
                                        <p class="no-prods">Aucun produits pour le moment</p>
                                    @else
                                        @foreach ($productsCatList->sortBy('display_order') as $product)
                                            @if ($product->active)
                                                <!-- $productsCatList -->
                                                @if ($subCategory->id === $product->subCategory)
                                                    <!-- $subCategory->id === $product->subCategory -->
                                                    <div class="product"
                                                        data-id="{{ route('showOne', [$product->id, $restaurant->id]) }}">
                                                        <!-- product -->
                                                        <div class="product-infos"> <!-- product-infos -->
                                                            <div class="prod-infos"
                                                                data-id="{{ route('showOne', [$product->id, $restaurant->id]) }}"
                                                                id="prod-{{ $product->id }}">
                                                                <h5>{{ $product->name }}</h5>
                                                                <p class="product-content">
                                                                    {{ Illuminate\Support\Str::limit($product->name, $limit = 20, $end = '...') }}
                                                                </p>
                                                                @if ($product->appellations && $product->appellations !== 'null')
                                                                    <div class="appellations">
                                                                        @foreach (json_decode($product->appellations) as $item)
                                                                            <img style="height:20px"
                                                                                src="{{ $url }}/images/appellations/{{ $item }}.png"
                                                                                alt="Icon {{ $item }}">
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                                <div class="open--details open-details-actions ">
                                                                    <p>{{ $product->price }} €</p>
                                                                </div>

                                                            </div>
                                                            @if ($restaurant->cart)
                                                                <div class="btn btn-primary addToCart" id=""
                                                                    style="position: relative; z-index:10000;"
                                                                    onclick="
                                                                const productName = this.getAttribute('data-productName');
                                                                const restauId = this.getAttribute('data-restau_id');
                                                                const quantity = 1;
                                                                const price = parseFloat(this.getAttribute('data-price')); // Convertir le prix en nombre à virgule flottante
                                                                let cart = JSON.parse(sessionStorage.getItem(`cart${restauId}`)) || [];

                                                                const existingProductIndex = cart.findIndex(item => item.productName === productName);

                                                                if (existingProductIndex !== -1) {
                                                                    alert(`Le produit a déjà été ajouté au panier, si vous souhaitez modifier la quantité faites le dans le panier.`)
                                                                    return;
                                                                } else {
                                                                    cart.push({ productName, quantity, price: price * quantity }); // Mettre le prix total dans le tableau
                                                                }
                                                            
                                                                // Mettre à jour le tableau cart dans sessionStorage
                                                                sessionStorage.setItem(`cart${restauId}`, JSON.stringify(cart));
                                                                afficherPanier()
                                                                alert(`Produit ajouté au panier avec succès ${productName}`)
                                                                "
                                                                    data-productName="{{ $product->name }}"
                                                                    data-price="{{ $product->price }}"
                                                                    data-restau_id="{{ $restaurant->id }}">Ajouter un
                                                                    panier
                                                                </div>
                                                            @endif
                                                        </div> <!-- product-infos -->
                                                        <figure class="product-image prod-infos"
                                                            data-id="{{ route('showOne', [$product->id, $restaurant->id]) }}">
                                                            @if ($product->image)
                                                                <img
                                                                    src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}">
                                                            @endif
                                                        </figure>
                                                    </div> <!-- product -->


                                                    {{--


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

    --}}
                                                @endif
                                                <!-- $subCategory->id === $product->subCategory -->
                                            @endif
                                        @endforeach <!-- $productsCatList -->
                                    @endif <!-- !$productsCatList -->
                                </div><!-- prod-cont -->
                            </div> <!-- products-container -->
                        @endforeach <!-- subCategories -->
                    </div><!-- products -->
                </div> <!-- container -->
            </div><!-- /#cible -->
        </section> <!-- resto products -->
    </section>
@endsection
