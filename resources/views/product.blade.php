<?php
$url = config('app.url');
?>

@extends('layouts.app')

@section('content')
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

        <div class="cible_rel" style="width: 100%;">

            <span class="remove_slide_prods">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                    </path>
                </svg>
            </span>
            @if ($product->image)
                <img style="max-width: calc(100% + 32px);
    width: calc(100% + 32px);
	max-height:40vh;
	object-fit:contain;
    margin-left: -16px;
    margin-top: -16px;"
                    src="{{ $url }}images/{{ $resto_id }}/{{ $product->image }}">
            @else
                <img src="{{ $url }}images/default-product-banner.jpg"
                    style="max-width: calc(100% + 32px);
                width: calc(100% + 32px);
                max-height:40vh;
                object-fit:contain;
                margin-left: -16px;
                margin-top: -16px;">
            @endif

            <h1>

                {{ $product->name }}</h1>
            <p class="p_price">{{ $product->price }} €</p>
            <h2>{!! nl2br(e($product->content)) !!}</h2>
            <div class="variants">
                @foreach ($product->variants as $item)
                    <div id="items" class="items"
                        style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px; justify-content:center;align-items:center;">
                        <h2 class="item-prod" style="grid-column: 1/2"><em><strong>{{ $item->name }}</strong></em></h2>
                        <h2 style="grid-column: 1/4">{!! nl2br(e($item->content)) !!}</h2>
                        <p class="p_price" style="justify-self: end; grid-column: 3/4;grid-row:1/2">{{ $item->price }} €
                        </p>
                    </div>
                    <hr style="margin-top: 5px; border:none; height:1px; background-color:#E4E4E7;">
                @endforeach
            </div>
            @if ($product->allergenes_list && $product->allergenes_list !== 'null')
                <h3>Allergenes</h3>
                <div class="appellations">
                    @foreach (json_decode($product->allergenes_list) as $item)
                       <h2><em>{{$item}}</em></h2>
                    @endforeach
                </div>
            @endif
            @if ($product->appellations && $product->appellations !== 'null')
                <div class="appellations">
                    @foreach (json_decode($product->appellations) as $item)
                        <img style="width:50px;height:50px"
                            src="{{ $url }}/images/appellations/{{ $item }}.png"
                            alt="Icon {{ $item }}">
                    @endforeach
                </div>
            @endif
        </div>
        <!-- /.cible_rel -->
    </div>
    <!-- /#cible -->
@endsection
