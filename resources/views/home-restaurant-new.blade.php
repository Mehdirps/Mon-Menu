<?php
$url = config('app.url');
?>




@extends('layouts.app')


@section('title')
    {{ $restaurant->name }}
@endsection

@section('content')
    <style>
        .wg-default {
            top: 0 !important;
            right: 0 !important;
            bottom: unset !important;
        }
    </style>

    <div id="open_app"></div>
    <!-- /#open_app -->

    <div id="loader" style="display: none;">
        <div class="loader-icon"></div>
    </div>

    <div id="category" class="slide_cats" style="padding-bottom: 80px;"></div>
    <!-- /#category -->

    <div id="details" class="slide_prods"></div>
    <!-- /#details -->


    <div id="tout_slide">

        <div>
            <img style="margin:auto; max-width:100%;display: block;text-align: center;"
                src="@if ($restaurant->banner) {{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->banner }}@else{{ $url }}img/gold-cutlery-set-black-background.jpg); @endif"
                alt="Banniere du restaurant {{ $restaurant->name }}">
        </div>



        <style>
            .return {
                display: flex;
                align-items: center;
                gap: 3px;
                margin: 10px 0;
                color: grey;
                width: max-content;
            }
        </style>

        <div class="new_resto_container">

            {{-- <a href="{{ route('vitrine') }}" class="return"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-sign-turn-slight-left" viewBox="0 0 16 16">
                    <path
                        d="m7.665 6.982-.8 1.386a.25.25 0 0 1-.451-.039l-1.06-2.882a.25.25 0 0 1 .192-.333l3.026-.523a.25.25 0 0 1 .26.371l-.667 1.154.621.373A2.5 2.5 0 0 1 10 8.632V11H9V8.632a1.5 1.5 0 0 0-.728-1.286l-.607-.364Z" />
                    <path fill-rule="evenodd"
                        d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435Zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134Z" />
                </svg> Revenir à l'accueil</a> --}}
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <h1 class="new_resto_name">
                <a
                    href="{{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}">{{ $restaurant->name }}</a>
            </h1>

            <span class="new_resto_content_left">
                <span class="new_resto_secondary_info">
                    <span class="starFull_infos">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor" style="fill: #27272a"
                                d="m5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z" />
                        </svg>
                        {{ $starFull }}/5 - {{ $opinionLength }} avis
                    </span>
                </span>
                <span class="new_resto_secondary_info" id="open_infos">

                    <span class="new_resto_secondary_info_address">
                        Cliquer ici pour plus d’informations
                    </span>
                    <!-- /.new_resto_secondary_info_address -->


                    <span class="new_resto_secondary_info_chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </span>
                    <!-- /.chevron -->

                </span>
            </span>

            <div class="new_resto_container"
                style="margin-left: auto;margin-right: auto;width: 100%;max-width: 1200px;background-color: #fff;">




                {{--
    
     <div class="new_resto_button">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="3.5" cy="7" r=".5" />
                        <circle cx="6.75" cy="7" r=".5" />
                        <circle cx="10" cy="7" r=".5" />
                        <path d="M7 .5a6.5 6.5 0 0 0-5.41 10.1L.5 13.5l3.65-.66A6.5 6.5 0 1 0 7 .5Z" />
                    </g>
                </svg>
                <p>Laisser votre avis !</p>
            </div>
            --}}
            </div>

            <ul class="new_resto_list_cats">

                @foreach ($categories->sortBy('display_order') as $category)
                    <li>
                        <a class="full-link"
                            href="{{ route('restaurant-products', [Str::slug($restaurant->name), $restaurant->id, $category->id]) }}">
                            <span
                                class="img"style="background-image: url(@if ($category->image) {{ $url }}categories-icons/{{ $category->image }}@else{{ $url }}images/default.png); @endif"></span>
                            <!-- /.img -->
                            <h4 class="new_resto_cat_title">{{ $category->name }}</h4>


                            <span class="chevron">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span>
                            <!-- /.chevron -->


                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="restaurant-footer-social-links" style="margin-bottom: 50px">
                @if ($restaurant->instagram !== null && $restaurant->instagram !== '')
                    <a class="header-insta" href="{{ $restaurant->instagram }}" target="_blank">


                        <svg width="24px" height="24px" viewBox="0 0 2500 2500" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <radialGradient id="0" cx="332.14" cy="2511.81" r="3263.54"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset=".09" stop-color="#fa8f21" />
                                    <stop offset=".78" stop-color="#d82d7e" />
                                </radialGradient>
                                <radialGradient id="1" cx="1516.14" cy="2623.81" r="2572.12"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset=".64" stop-color="#8c3aaa" stop-opacity="0" />
                                    <stop offset="1" stop-color="#8c3aaa" />
                                </radialGradient>
                            </defs>
                            <path
                                d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57"
                                fill="url(#0)" />
                            <path
                                d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57"
                                fill="url(#1)" />
                        </svg>

                    </a>
                @endif
                @if ($restaurant->facebook !== null && $restaurant->facebook !== '')
                    <a class="header-fcb" href="{{ $restaurant->facebook }}" target="_blank">


                        <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                            y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;"
                            xml:space="preserve">
                            <style type="text/css">
                                .st0rerer {
                                    fill: #1877F2;
                                }

                                .st1fdfdf {
                                    fill: #FFFFFF;
                                }
                            </style>
                            <path class="st0rerer"
                                d="M3.6,0h16.8c2,0,3.6,1.6,3.6,3.6v16.8c0,2-1.6,3.6-3.6,3.6H3.6c-2,0-3.6-1.6-3.6-3.6V3.6C0,1.6,1.6,0,3.6,0z" />
                            <path class="st1fdfdf"
                                d="M16.7,15.5l0.5-3.5h-3.3V9.8c0-0.9,0.5-1.9,2-1.9h1.5v-3c0,0-1.4-0.2-2.7-0.2c-2.7,0-4.5,1.7-4.5,4.7V12h-3v3.5
  h3V24h3.7v-8.5H16.7z" />
                        </svg>

                    </a>
                @endif
                @if ($restaurant->tripadvisor !== null && $restaurant->tripadvisor !== '')
                    <a class="header-trip" href="{{ $restaurant->tripadvisor }}" target="_blank">
                        <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_2_1_"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                            y="0px" viewBox="0 0 38.4 24" style="enable-background:new 0 0 38.4 24;"
                            xml:space="preserve">
                            <style type="text/css">
                                .st0212121212156 {
                                    fill: #34E0A1;
                                }
                            </style>
                            <path class="st0212121212156"
                                d="M9.6,9.6c-2.7,0-4.8,2.2-4.8,4.8s2.2,4.8,4.8,4.8s4.8-2.2,4.8-4.8C14.4,11.7,12.3,9.6,9.6,9.6L9.6,9.6z
  M9.6,17.8c-1.9,0-3.4-1.5-3.4-3.4S7.7,11,9.6,11s3.4,1.5,3.4,3.4C13,16.3,11.5,17.8,9.6,17.8z" />
                            <circle class="st0212121212156" cx="9.6" cy="14.4" r="2.4" />
                            <path class="st0212121212156"
                                d="M28.8,9.6c-2.7,0-4.8,2.2-4.8,4.8s2.2,4.8,4.8,4.8s4.8-2.2,4.8-4.8S31.5,9.6,28.8,9.6z M28.8,17.8
  c-1.9,0-3.4-1.5-3.4-3.4s1.5-3.4,3.4-3.4c1.9,0,3.4,1.5,3.4,3.4C32.2,16.3,30.7,17.8,28.8,17.8z" />
                            <circle class="st0212121212156" cx="28.8" cy="14.4" r="2.4" />
                            <path class="st0212121212156"
                                d="M35.6,7.6l2.8-2.8h-5.7C29.4,2.2,24.1,0,19.2,0C14.2,0,8.9,2.2,5.7,4.8H0l2.8,2.8C1.1,9.3,0,11.7,0,14.4
  C0,19.7,4.3,24,9.6,24c2.4,0,4.7-0.9,6.4-2.4l3.3,2.4l3.2-2.3l0-0.1c1.7,1.5,3.9,2.4,6.4,2.4c5.3,0,9.6-4.3,9.6-9.6
  C38.4,11.7,37.3,9.3,35.6,7.6L35.6,7.6z M27.6,4.9c-4.5,0.6-8.1,4.3-8.4,9c-0.3-4.6-3.9-8.4-8.4-9c2.3-1.6,5.2-2.5,8.4-2.5
  S25.3,3.2,27.6,4.9z M9.6,21.6c-4,0-7.2-3.2-7.2-7.2s3.2-7.2,7.2-7.2s7.2,3.2,7.2,7.2C16.8,18.4,13.6,21.6,9.6,21.6z M28.8,21.6
  c-4,0-7.2-3.2-7.2-7.2s3.2-7.2,7.2-7.2s7.2,3.2,7.2,7.2C36,18.4,32.8,21.6,28.8,21.6z" />
                        </svg>

                    </a>
                @endif
                @if ($restaurant->website !== null && $restaurant->website !== '')
                    <a class="header-website" href="{{ $restaurant->website }}" target="_blank"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M16.36 14c.08-.66.14-1.32.14-2c0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2m-5.15 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 0 1-4.33 3.56M14.34 14H9.66c-.1-.66-.16-1.32-.16-2c0-.68.06-1.35.16-2h4.68c.09.65.16 1.32.16 2c0 .68-.07 1.34-.16 2M12 19.96c-.83-1.2-1.5-2.53-1.91-3.96h3.82c-.41 1.43-1.08 2.76-1.91 3.96M8 8H5.08A7.923 7.923 0 0 1 9.4 4.44C8.8 5.55 8.35 6.75 8 8m-2.92 8H8c.35 1.25.8 2.45 1.4 3.56A8.008 8.008 0 0 1 5.08 16m-.82-2C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2c0 .68.06 1.34.14 2M12 4.03c.83 1.2 1.5 2.54 1.91 3.97h-3.82c.41-1.43 1.08-2.77 1.91-3.97M18.92 8h-2.95a15.65 15.65 0 0 0-1.38-3.56c1.84.63 3.37 1.9 4.33 3.56M12 2C6.47 2 2 6.5 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2Z" />
                        </svg></a>
                @endif
                @if ($restaurant->tiktok !== null && $restaurant->tiktok !== '')
                    <a class="header-tiktok" href="{{ $restaurant->tiktok }}" target="_blank">


                        <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                            y="0px" viewBox="0 0 21.2 24" style="enable-background:new 0 0 21.2 24;"
                            xml:space="preserve">
                            <style type="text/css">
                                .st01212 {
                                    fill: #EE1D52;
                                }

                                .st1kfjgkfglf {
                                    fill: #FFFFFF;
                                }

                                .st2gfjkfglkfgf {
                                    fill: #69C9D0;
                                }
                            </style>
                            <g>
                                <path class="st01212"
                                    d="M15.7,8.7c1.5,1.1,3.4,1.8,5.5,1.8V6.5c-0.4,0-0.8,0-1.2-0.1v3.1c-2.1,0-3.9-0.7-5.5-1.8v8
    c0,4-3.3,7.3-7.3,7.3c-1.5,0-2.9-0.5-4.1-1.2C4.6,23.2,6.4,24,8.4,24c4,0,7.3-3.3,7.3-7.3L15.7,8.7L15.7,8.7z M17.2,4.7
    c-0.8-0.9-1.3-2-1.4-3.2V1h-1.1C14.9,2.5,15.9,3.9,17.2,4.7L17.2,4.7z M5.8,18.7c-0.4-0.6-0.7-1.3-0.7-2c0-1.8,1.5-3.3,3.3-3.3
    c0.3,0,0.7,0.1,1,0.2v-4C9.1,9.4,8.7,9.4,8.3,9.4v3.1c-0.3-0.1-0.7-0.2-1-0.2c-1.8,0-3.3,1.5-3.3,3.3C3.9,17,4.7,18.2,5.8,18.7z" />
                                <path class="st1kfjgkfglf"
                                    d="M14.6,7.7c1.6,1.1,3.4,1.8,5.5,1.8V6.4c-1.1-0.2-2.2-0.8-2.9-1.7c-1.3-0.8-2.2-2.2-2.5-3.7h-2.9v15.8
    c0,1.8-1.5,3.3-3.3,3.3c-1.1,0-2-0.5-2.7-1.3c-1.1-0.5-1.8-1.7-1.8-3c0-1.8,1.5-3.3,3.3-3.3c0.4,0,0.7,0.1,1,0.2V9.4
    c-4,0.1-7.1,3.3-7.1,7.3c0,2,0.8,3.8,2.1,5.1C4.4,22.6,5.8,23,7.3,23c4,0,7.3-3.3,7.3-7.3L14.6,7.7z" />
                                <path class="st2gfjkfglkfgf"
                                    d="M20.1,6.4V5.5c-1,0-2-0.3-2.9-0.8C17.9,5.5,19,6.1,20.1,6.4z M14.6,1c0-0.2,0-0.3-0.1-0.5V0h-4v15.8
    c0,1.8-1.5,3.3-3.3,3.3c-0.5,0-1-0.1-1.5-0.4C6.4,19.5,7.4,20,8.4,20c1.8,0,3.3-1.5,3.3-3.3V1H14.6z M8.3,9.4V8.5
    c-0.3,0-0.7-0.1-1-0.1c-4,0-7.3,3.3-7.3,7.3c0,2.5,1.3,4.7,3.2,6.1c-1.3-1.3-2.1-3.1-2.1-5.1C1.2,12.7,4.3,9.5,8.3,9.4L8.3,9.4z" />
                            </g>
                        </svg>


                    </a>
                @endif

                @if ($restaurant->google_review_link !== null && $restaurant->google_review_link !== '')
                    <a class="header-google_review_link" href="{{ $restaurant->google_review_link }}" target="_blank">



                        <svg width="24px" height="24px" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg"
                            preserveAspectRatio="xMidYMid">
                            <path
                                d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                                fill="#4285F4" />
                            <path
                                d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                fill="#34A853" />
                            <path
                                d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                                fill="#FBBC05" />
                            <path
                                d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                                fill="#EB4335" />
                        </svg>


                    </a>
                @endif
            </div>
        </div>
        <!-- /.new_resto_container -->



        <div class="restaurant_infos">
            <div id="close-infos">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                    <path fill="currentColor"
                        d="M16 2C8.2 2 2 8.2 2 16s6.2 14 14 14s14-6.2 14-14S23.8 2 16 2zm5.4 21L16 17.6L10.6 23L9 21.4l5.4-5.4L9 10.6L10.6 9l5.4 5.4L21.4 9l1.6 1.6l-5.4 5.4l5.4 5.4l-1.6 1.6z" />
                </svg>
            </div>
            <style>
                #close-infos {
                    position: absolute;
                    top: 100px;
                    right: 10px;
                    z-index: 100000000000000;
                    cursor: pointer;
                }
            </style>
            <span class="restaurant_infos_close"></span>
            <!-- /.restaurant_infos_close -->


            <div id="map"></div><!-- /#map -->

            <div class="new_resto_container">


                <div class="restaurant_infos_name">{{ $restaurant->name }}</div>

                <!-- /.restaurant_infos_name -->
                @if ($restaurant->content)
                    <div class="restaurant_infos_line">
                        <div class="restaurant_infos_icones">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </div>
                        <!-- /.restaurant_infos_icones -->
                        <div class="restaurant_infos_txt">
                            {{ $restaurant->content }}
                        </div>
                        <!-- /.restaurant_infos_txt -->
                    </div>
                @endif
                <!-- /.restaurant_infos_line -->

                <div class="restaurant_infos_line">
                    <div class="restaurant_infos_icones">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg>
                    </div>
                    <!-- /.restaurant_infos_icones -->
                    <div class="restaurant_infos_txt">
                        <span>{{ $starFull }}/5 - {{ $opinionLength }} avis</span>
                        <span style="margin-left:20px; cursor:pointer; opacity: .5;" class="button"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M20.7 7c-.3.4-.7.7-.7 1c0 .3.3.6.6 1c.5.5 1 .9.9 1.4c0 .5-.5 1-1 1.5L16.4 16L15 14.7l4.2-4.2l-1-1l-1.4 1.4L13 7.1l4-3.8c.4-.4 1-.4 1.4 0l2.3 2.3c.4.4.4 1.1 0 1.4M3 17.2l9.6-9.6l3.7 3.8L6.8 21H3v-3.8M7 2v3h3v2H7v3H5V7H2V5h3V2h2Z" />
                            </svg>
                        </span>
                        <span class="open_opinions open_chevron" style="margin-left: auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                    </div>
                    <!-- /.restaurant_infos_txt -->
                </div>
                <div class="opinions-container">
                    <h3>Avis</h3>
                    <span class="starFull_infos">
                        @if ($starFull > 0)
                            @for ($i = 0; $i < $starFull; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor" style="fill: #FFA800"
                                        d="m5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z" />
                                </svg>
                            @endfor
                            @for ($i = 0; $i < $starEmpty; $i++)
                                <svg width="24" height="24" viewBox="0 0 18 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" style="opacity: .2;">
                                    <path
                                        d="M6.375 12.8542L9 11.2708L11.625 12.875L10.9375 9.875L13.25 7.875L10.2083 7.60417L9 4.77083L7.79167 7.58333L4.75 7.85417L7.0625 9.875L6.375 12.8542ZM3.85417 16.3333L5.20833 10.4792L0.666667 6.54167L6.66667 6.02083L9 0.5L11.3333 6.02083L17.3333 6.54167L12.7917 10.4792L14.1458 16.3333L9 13.2292L3.85417 16.3333Z"
                                        fill="#000" />
                                </svg>
                            @endfor
                        @else
                            <p class="open">Il n’y a pas encore d’avis.Soyez le premier à laisser votre avis</p>
                        @endif
                    </span>
                    <div class="opinions-list">
                        <div class="opinion-container">
                            @foreach ($restaurant->opinions as $item)
                                <div class="opinion">
                                    <div class="opinion-infos">
                                        <h4 class="opinion-author">{{ $item->author }}</h4>
                                        <p class="opinion-date">{{ substr($item->created_at, 0, 10) }}</p>
                                        <div class="opinion-note">
                                            @for ($i = 0; $i < $item->note; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor" style="fill: #FFA800"
                                                        d="m5.825 22l1.625-7.025L2 10.25l7.2-.625L12 3l2.8 6.625l7.2.625l-5.45 4.725L18.175 22L12 18.275L5.825 22Z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                    @if ($item->comment)
                                        <div class="opinion-comment">
                                            {{ $item->comment }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <style>
                        .opinions-container {
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                            align-items: center;
                            gap: 20px;
                            width: 100%;
                            height: 0;
                            transition: all .25s linear;
                            overflow: hidden;
                        }

                        .opinions-list {
                            width: 100%;
                            max-width: 700px;
                        }

                        .opinion-container {
                            max-height: 400px;
                            overflow: scroll;
                        }

                        .open-opinions {
                            height: 550px;
                        }

                        .opinion {
                            border-top: 2px solid #9d9d9d61;
                        }

                        .open_opinions-active {
                            transform: rotate(90deg);
                            transition: all .2s linear;
                        }

                        .opinion-infos {
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            justify-content: center;
                            align-items: center;
                            gap: 10px;
                            padding: 15px;

                        }

                        .opinion-infos h4 {
                            color: #4b4b4b;
                            font-size: 20px;
                        }

                        .opinion-date {
                            font-size: 16px;
                            opacity: .7;
                        }

                        .opinion-comment {
                            padding: 0 15px;
                        }
                    </style>
                    <script>
                        document.querySelector('.open_opinions').addEventListener('click', () => {
                            document.querySelector('.opinions-container').classList.toggle('open-opinions');
                            document.querySelector('.open_opinions').classList.toggle('open_opinions-active');
                            document.querySelector('.opinion-form-container').classList.remove('open-form');
                        })
                    </script>
                </div>
                <div class="opinion-form-container">
                    <div class="opinion-form">
                        <form action="{{ route('restaurant-opinion', $restaurant->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <p class="form-error"></p>
                            <div class="form-input">
                                <div class="author">
                                    <label for="author">Votre nom et prénom</label>
                                    <input type="text" name="author" id="author">
                                </div>
                                <div class="email">
                                    <label for="email">Votre adresse email</label>
                                    <input type="email" name="email" id="email">
                                </div>
                                <div class="comment">
                                    <label for="comment">Commentaire</label>
                                    <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="note">
                                <label for="note">Votre note</label>
                                <select name="note" id="note" style="display: none">
                                    <option value="0">0/5</option>
                                    <option value="1">1/5</option>
                                    <option value="2">2/5</option>
                                    <option value="3">3/5</option>
                                    <option value="4">4/5</option>
                                    <option value="5">5/5</option>
                                </select>
                            </div>
                            <div class="rating-stars text-center">
                                <ul id="stars">
                                    <li class="star selected" title="Poor" data-value="1">
                                        <i class="fa fa-star fa-fw" aria-hidden="true"></i>
                                    </li>
                                    <li class="star" title="Fair" data-value="2">
                                        <i class="fa fa-star fa-fw" aria-hidden="true"></i>
                                    </li>
                                    <li class="star" title="Good" data-value="3">
                                        <i class="fa fa-star fa-fw" aria-hidden="true"></i>
                                    </li>
                                    <li class="star" title="Excellent" data-value="4">
                                        <i class="fa fa-star fa-fw" aria-hidden="true"></i>
                                    </li>
                                    <li class="star" title="WOW!!!" data-value="5">
                                        <i class="fa fa-star fa-fw" aria-hidden="true"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="success-box">
                                <div class="clearfix"></div>
                                <div class="text-message"></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="rgpd">
                                <input type="checkbox" class="demo5" id="rgpd">
                                <label for="rgpd"></label>
                                <p>J'accepte que mes données soient récoltés dans le cadre du traitement
                                    de cet avis</p>
                            </div>
                            <input type="hidden" value="{{ $restaurant->id }}" name="restaurant_id">
                            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 14 14">
                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="3.5" cy="7" r=".5" />
                                        <circle cx="6.75" cy="7" r=".5" />
                                        <circle cx="10" cy="7" r=".5" />
                                        <path d="M7 .5a6.5 6.5 0 0 0-5.41 10.1L.5 13.5l3.65-.66A6.5 6.5 0 1 0 7 .5Z" />
                                    </g>
                                </svg> Valider mon avis</button>
                        </form>
                    </div>
                </div>
                <!-- /.restaurant_infos_line -->
                <style>
                    .rating-stars ul {
                        list-style-type: none;
                        padding: 0;
                        -moz-user-select: none;
                        -webkit-user-select: none
                    }

                    .rating-stars ul>li.star {
                        display: inline-block
                    }

                    .rating-stars ul>li.star>i.fa {
                        font-size: 24px;
                        color: #ccc
                    }

                    .rating-stars ul>li.star.hover>i.fa {
                        color: #FFCC36
                    }

                    .rating-stars ul>li.star.selected>i.fa {
                        color: #FF912C
                    }
                </style>

                <div class="restaurant_infos_line">
                    <div class="restaurant_infos_icones">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m6.35 15.35l-2.1-2.15q1.475-1.475 3.463-2.337T12 10q2.3 0 4.288.875t3.462 2.375l-2.1 2.1q-1.1-1.1-2.55-1.725T12 13q-1.65 0-3.1.625T6.35 15.35ZM2.1 11.1L0 9q2.3-2.35 5.375-3.675T12 4q3.55 0 6.625 1.325T24 9l-2.1 2.1q-1.925-1.925-4.463-3.013T12 7Q9.1 7 6.562 8.088T2.1 11.1ZM12 21l3.525-3.55q-.675-.675-1.575-1.063T12 16q-1.05 0-1.95.388T8.475 17.45L12 21Z" />
                        </svg>
                    </div>
                    <!-- /.restaurant_infos_icones -->
                    <div class="restaurant_infos_txt">
                        <span>{{ $design->wifiSsid }}</span>
                        <span data-password="{{ $design->wifiPassword }}" id="copyButton"
                            style="margin-left: auto; cursor:pointer; opacity: .5;"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <g fill="currentColor">
                                    <path
                                        d="M15.24 2h-3.894c-1.764 0-3.162 0-4.255.148c-1.126.152-2.037.472-2.755 1.193c-.719.721-1.038 1.636-1.189 2.766C3 7.205 3 8.608 3 10.379v5.838c0 1.508.92 2.8 2.227 3.342c-.067-.91-.067-2.185-.067-3.247v-5.01c0-1.281 0-2.386.118-3.27c.127-.948.413-1.856 1.147-2.593c.734-.737 1.639-1.024 2.583-1.152c.88-.118 1.98-.118 3.257-.118h3.07c1.276 0 2.374 0 3.255.118A3.601 3.601 0 0 0 15.24 2Z" />
                                    <path
                                        d="M6.6 11.397c0-2.726 0-4.089.844-4.936c.843-.847 2.2-.847 4.916-.847h2.88c2.715 0 4.073 0 4.917.847c.843.847.843 2.21.843 4.936v4.82c0 2.726 0 4.089-.843 4.936c-.844.847-2.202.847-4.917.847h-2.88c-2.715 0-4.073 0-4.916-.847c-.844-.847-.844-2.21-.844-4.936v-4.82Z" />
                                </g>
                            </svg>
                        </span>
                        <span id="copyMessage" style="margin-left: 5px; display: none;">Mot de passe copié !</span>
                    </div>
                    <script>
                        // Récupérer le bouton en utilisant son ID
                        const copyButton = document.getElementById('copyButton');
                        // Récupérer l'élément pour afficher le message
                        const copyMessage = document.getElementById('copyMessage');

                        // Ajouter un écouteur d'événement de clic
                        copyButton.addEventListener('click', () => {
                            // Récupérer la valeur de l'attribut data-password
                            const password = copyButton.getAttribute('data-password');

                            // Créer un élément textarea temporaire
                            const textarea = document.createElement('textarea');
                            textarea.value = password;

                            // Ajouter le textarea à la page pour pouvoir le sélectionner
                            document.body.appendChild(textarea);

                            // Sélectionner le contenu du textarea
                            textarea.select();

                            // Copier le contenu sélectionné dans le presse-papiers
                            document.execCommand('copy');

                            // Supprimer le textarea temporaire car il n'est plus nécessaire
                            document.body.removeChild(textarea);

                            // Afficher le message pendant 2 secondes
                            copyMessage.style.display = 'inline';
                            setTimeout(() => {
                                copyMessage.style.display = 'none';
                            }, 1500);
                        });
                    </script>
                    <!-- /.restaurant_infos_txt -->
                </div>
                <!-- /.restaurant_infos_line -->

                <div class="restaurant_infos_line">
                    <div class="restaurant_infos_icones">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z" />
                            <path fill-rule="evenodd"
                                d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z" />
                        </svg>
                    </div>
                    <!-- /.restaurant_infos_icones -->
                    <div class="restaurant_infos_txt">
                        <a class="restaurant_infos_address"
                            href="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ $restaurant->address }}t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;"
                            target="_blank"> {{ $restaurant->address }} </a>
                    </div>
                    <!-- /.restaurant_infos_txt -->
                </div>
                <!-- /.restaurant_infos_line -->


                <div class="restaurant_infos_line">
                    <div class="restaurant_infos_icones">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-telephone" viewBox="0 0 16 16">
                            <path
                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                        </svg>
                    </div>
                    <!-- /.restaurant_infos_icones -->
                    <div class="restaurant_infos_txt">
                        {{ $restaurant->mobile }}
                    </div>
                    <!-- /.restaurant_infos_txt -->
                </div>
                <!-- /.restaurant_infos_line -->


                <div class="restaurant_infos_line line_hours">
                    <div class="restaurant_infos_icones">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                        </svg>
                    </div>
                    <!-- /.restaurant_infos_icones -->
                    <div class="restaurant_infos_txt">
                        <span class="open_hours">Horaires</span>
                        <!-- /.open_hours -->
                        <span class="open_hours open_chevron">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </span>
                        <!-- /.open_hours open_chevron -->

                        <div class="restaurant_infos_hours">
                            @if (
                                $restaurant->lundi ||
                                    $restaurant->mardi ||
                                    $restaurant->mercredi ||
                                    $restaurant->jeudi ||
                                    $restaurant->vendredi ||
                                    $restaurant->samedi ||
                                    $restaurant->dimanche)
                                <div class="hours">
                                    @if ($restaurant->lundi)
                                        <div class="hour">
                                            <p>Lundi : </p>
                                            @if ($restaurant->lundi == '-')
                                                Fermé
                                            @else
                                                {{ $restaurant->lundi }}
                                            @endif
                                            </span>
                                        </div>
                                    @endif
                                    @if ($restaurant->mardi)
                                        <div class="hour">
                                            <p>Mardi : </p>
                                            @if ($restaurant->mardi == '-')
                                                Fermé
                                            @else
                                                {{ $restaurant->mardi }}
                                            @endif
                                            </span>
                                        </div>
                                    @endif
                                    @if ($restaurant->mercredi)
                                        <div class="hour">
                                            <p>Mercredi : </p>
                                            @if ($restaurant->mercredi == '-')
                                                Fermé
                                            @else
                                                {{ $restaurant->mercredi }}
                                            @endif
                                            </span>
                                        </div>
                                    @endif
                                    @if ($restaurant->jeudi)
                                        <div class="hour">
                                            <p>Jeudi : </p>
                                            @if ($restaurant->jeudi == '-')
                                                Fermé
                                            @else
                                                {{ $restaurant->jeudi }}
                                            @endif
                                            </span>
                                        </div>
                                    @endif
                                    @if ($restaurant->vendredi)
                                        <div class="hour">
                                            <p>Vendredi : </p>
                                            @if ($restaurant->vendredi == '-')
                                                Fermé
                                            @else
                                                {{ $restaurant->vendredi }}
                                            @endif
                                            </span>
                                        </div>
                                    @endif
                                    @if ($restaurant->samedi)
                                        <div class="hour">
                                            <p>Samedi : </p>
                                            @if ($restaurant->samedi == '-')
                                                Fermé
                                            @else
                                                {{ $restaurant->samedi }}
                                            @endif
                                            </span>
                                        </div>
                                    @endif
                                    @if ($restaurant->dimanche)
                                        <div class="hour">
                                            <p>Dimanche : </p>
                                            @if ($restaurant->dimanche == '-')
                                                Fermé
                                            @else
                                                {{ $restaurant->dimanche }}
                                            @endif
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <!-- restaurant_infos_hours -->




                    </div>
                    <!-- /.restaurant_infos_txt -->
                </div>
                <!-- /.restaurant_infos_line -->

            </div>
            <!-- /.new_resto_container -->


        </div> <!-- /.restaurant_infos -->


        <!-- / -->

        {{-- @include('partial.restaurant-footer') --}}


    </div>
    <!-- /#tout_slide -->
    <style>
        .form-input {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            max-width: 900px;
            margin: auto;
        }

        .form-input div {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
        }

        .opinion-form-container {
            background-color: rgba(0, 0, 0, 0.266);
            height: 0;
            overflow: hidden;
            transition: all .5s linear;
        }

        .open-form {
            height: max-content;
            transition: all .5s linear;
        }

        .opinion-form-container .opinion-form {
            background-color: white;
            overflow: hidden;
            position: relative;
        }

        .opinion-form-container .opinion-form .close-form {
            width: 30px;
            height: 30px;
            color: white;
            cursor: pointer;
        }

        .opinion-form-container .opinion-form figure {
            width: 100%;
            height: 150px;
        }

        .opinion-form-container .opinion-form figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
        }

        .opinion-form-container .opinion-form h3 {
            font-size: 14px;
            margin: 20px auto;
        }

        .opinion-form-container .opinion-form form {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .opinion-form-container .opinion-form form textarea {
            resize: none;
            padding: 10px 20px;
            border: 2px solid #4b4b4b;
            border-radius: 20px;
            margin: 10px 0 0 0;
            width: 100%;
        }

        .opinion-form-container .opinion-form form .form-error {
            color: red;
        }

        .opinion-form-container .opinion-form form input {
            padding: 10px 20px;
            border: 2px solid #4b4b4b;
            border-radius: 500px;
            margin: 10px 0 0 0;
            width: 100%;
        }


        .opinion-form-container .opinion-form form div:nth-of-type(2) {
            display: flex;
            flex-direction: column;
            margin: auto;
        }

        .opinion-form-container .opinion-form form div:nth-of-type(2) {
            width: max-content;
        }

        .opinion-form-container .opinion-form form input[type="checkbox"].demo5 {
            display: none;
        }

        .opinion-form-container .opinion-form form input[type="checkbox"].demo5+label {
            box-sizing: border-box;
            display: inline-block;
            width: 3rem;
            height: 1.5rem;
            border-radius: 1.5rem;
            padding: 2px;
            background-color: #cccccc;
            transition: all 0.5s;
        }

        .opinion-form-container .opinion-form form input[type="checkbox"].demo5+label::before {
            box-sizing: border-box;
            display: block;
            content: "";
            height: calc(1.5rem - 4px);
            width: calc(1.5rem - 4px);
            border-radius: 50%;
            background-color: #fff;
            transition: all 0.5s;
        }

        .opinion-form-container .opinion-form form input[type="checkbox"].demo5:checked+label {
            background-color: #4b4b4b;
        }

        .opinion-form-container .opinion-form form input[type="checkbox"].demo5:checked+label::before {
            margin-left: 1.5rem;
        }

        .opinion-form-container .opinion-form form button {
            width: max-content;
            margin: auto;
            padding: 10px;
            border-radius: 500px;
            background-color: #4b4b4b;
            color: white;
            border: unset;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }
    </style>
@endsection


@section('footer-js')
    <script>
        const opinionForm = document.querySelector('form');
        opinionForm.addEventListener('submit', (e) => {
            const author = e.target.author.value;
            const email = e.target.email.value;
            const note = e.target.note.value;
            const rgpd = e.target.rgpd.checked;

            if (author === "" || email === "" || note <= 0 || note > 5 || rgpd === false) {
                e.preventDefault();
                document.querySelector('.form-error').textContent =
                    "Une erreur à été détecter lors de la soumission du formulaire ! Un champ n'a pas été renseigné."
            }

        })
    </script>
    <script>
        $(document).ready(function() {

            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10);

                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });

            $('#stars li').on('click', function() {
                var onStar = parseInt($(this).data('value'), 10);
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);

                $('#note').val(ratingValue);

                var msg = "";
                if (ratingValue > 1) {
                    msg = "Merci! Tu as noté " + ratingValue + " étoiles.";
                } else {
                    msg = "Merci! Tu as noté " + ratingValue + " étoile.";
                }

                responseMessage(msg);

            });


        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }


        const form = document.querySelector('.opinion-form-container');
        document.querySelector('.button').addEventListener('click', () => {
            form.classList.toggle('open-form');
            document.querySelector('.opinions-container').classList.remove('open-opinions');
            document.querySelector('.open_opinions').classList.remove('open_opinions-active');
        });
    </script>
    <script src="{{ $url }}/build/assets/leaflet.js"></script>

    <script>
        open_infos = $('#open_infos');
        restaurant_infos = $('.restaurant_infos');
        open_app = $('#open_app');
        app = $('#app');
        open_hours = $('.open_hours');
        hours = $('.hours');
        line_hours = $('.line_hours');
        close_infos = $('#close-infos');

        open_infos.click(function(e) {
            e.stopPropagation();
            restaurant_infos.addClass('open');
            app.addClass('open');
        })

        close_infos.click(function() {
            restaurant_infos.removeClass('open');
            app.removeClass('open');
        })

        open_app.click(function() {
            restaurant_infos.removeClass('open');
            app.removeClass('open');
        })

        open_hours.click(function() {
            line_hours.toggleClass('open');
            hours.toggleClass('open');
        })



        var startlat = {{ $restaurant->lat }};
        var startlon = {{ $restaurant->lon }};

        var options = {
            center: [startlat, startlon],
            zoom: 7
        }

        var map = L.map('map', options);
        var nzoom = 6;

        var greenIcon = L.icon({
            iconUrl: '{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->logo }}',

            iconSize: [50, 50],
            iconAnchor: [50, 50],
            popupAnchor: [-25, -25]
        });

        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: 'OSM'
        }).addTo(map);

        var myMarker = L.marker([startlat, startlon], {
            title: "Coordinates",
            alt: "Coordinates",
            icon: greenIcon,
            draggable: false
        }).addTo(map);
    </script>


    <script>
        $(document).on('click', '.remove_slide_cats', function() {
            $('#category').html('');
            $('#details').html('');
            $('.slide_cats').removeClass('arrive');
            $('.slide_prods').removeClass('arrive');
            $('#tout_slide').removeClass('part');
        });

        $(document).on('click', '.slide_prods', function() {
            $('#details').html('');
            $('.slide_prods').removeClass('arrive');
        });

        $(document).on('click', '.selector_menu li', function() {
            $('.selector_menu li').removeClass('active');
            $(this).addClass('active');
        });




        $('.new_resto_list_cats a').click(function(event) {
            $('#category').html('');
            $('#details').html('');

            event.preventDefault();

            href = $(this).attr('href');

            $('#loader').show();

            $.ajax({
                url: href,
                method: 'GET',
                success: function(response) {
                    content = $(response).find('#cible').html();
                    $('#category').html(content);
                },
                error: function() {
                    $('#category').html('');
                },
                complete: function() {
                    $('#loader').hide();

                    $('#category').addClass('arrive');
                    $('#tout_slide').addClass('part');




                    var products = $('.product');
                    var selector_menu_li = $('.selector_menu li');

                    setTimeout(function() {
                        $('.menu_title').addClass('show_prod');
                    }, 250);

                    setTimeout(function() {
                        $('.restaurant-desc').addClass('show_prod');
                    }, 250);



                    var delay = 125;
                    setTimeout(function() {
                        products.each(function(index) {
                            var product = $(this);
                            setTimeout(function() {
                                product.addClass('show_prod');
                            }, index * delay);
                        });
                    }, 250);

                    selector_menu_li.each(function(index) {
                        var li = $(this);
                        setTimeout(function() {
                            li.addClass('show_prod');
                        }, index * delay);
                    });



                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 500);

                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("#category").offset().top
                        }, 500);
                    }, 500);
                }
            });
        });


        $(document).on('click', '.prod-infos', function(event) {
            $('#details').html('');
            $('#details').removeClass('arrive');

            event.preventDefault();

            href = $(this).data('id');
            
            $('#loader').show();

            $.ajax({
                url: href,
                method: 'GET',
                success: function(response) {
                    content = $(response).find('#cible').html();
                    console.log('response', response);
                    $('#details').html(content);
                },
                error: function() {
                    $('#details').html('');
                },
                complete: function() {
                    $('#loader').hide();

                    $('#details').addClass('arrive');
                    // $('#details').addClass('part');


                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 500);

                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("#details").offset().top
                        }, 500);
                    }, 500);
                }
            });
        });
    </script>
@endsection
