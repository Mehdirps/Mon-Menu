<?php
$url = config('app.url');
?>


@extends('layouts.app')


@section('content')


<style>
    @media(max-width:1000px){
        .resto_cats{
            justify-content: start;
        }
    }
</style>

<section class="restaurant">
    <header class="restaurant-header">
        @include('partial.restaurant-name')
        <div class="restaurant-images">


<div class="resto_banner" style="background-image: url(@if ($restaurant->banner){{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->banner }}@else{{ $url }}img/gold-cutlery-set-black-background.jpg);@endif" ></div>



{{--

            <figure class="restaurant-banner">
                @if ($restaurant->banner)
                <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->banner }}"
                alt="Image de la categorie {{ $restaurant->name }}">
                @else
                <img src="{{ $url }}img/gold-cutlery-set-black-background.jpg" alt="Bannière par default">
                @endif
            </figure>

    --}}
            <figure class="restaurant-logo">
                @if ($restaurant->logo)
                <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->logo }}"
                alt="Logo du restaurant {{ $restaurant->name }}">
                @else
                <img src="{{ $url }}img/logo-4.svg" alt="Logo du restaurant {{ $restaurant->name }}"
                style="object-fit: initial">
                @endif
            </figure>
        </div>
        <div class="restaurant-infos">
            <div class="phone">
                <span class="restaurant_mobile">
                    <span class="restaurant_mobile_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
</svg>
                    </span>
                    <!-- /.restaurant_mobile_icon -->
                    {{ $restaurant->mobile }}</span>



 <div class="restaurant-header-social-links">
        @if ($restaurant->instagram !== null && $restaurant->instagram !== '')
        <a class="header-insta" href="{{ $restaurant->instagram }}" target="_blank">


          <svg width="24px" height="24px" viewBox="0 0 2500 2500" xmlns="http://www.w3.org/2000/svg"><defs><radialGradient id="0" cx="332.14" cy="2511.81" r="3263.54" gradientUnits="userSpaceOnUse"><stop offset=".09" stop-color="#fa8f21"/><stop offset=".78" stop-color="#d82d7e"/></radialGradient><radialGradient id="1" cx="1516.14" cy="2623.81" r="2572.12" gradientUnits="userSpaceOnUse"><stop offset=".64" stop-color="#8c3aaa" stop-opacity="0"/><stop offset="1" stop-color="#8c3aaa"/></radialGradient></defs><path d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57" fill="url(#0)"/><path d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57" fill="url(#1)"/></svg>

        </a>
        @endif
        @if ($restaurant->facebook !== null && $restaurant->facebook !== '')
        <a class="header-fcb" href="{{ $restaurant->facebook }}" target="_blank">


         <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
         <style type="text/css">
          .st0rerer{fill:#1877F2;}
          .st1fdfdf{fill:#FFFFFF;}
        </style>
        <path class="st0rerer" d="M3.6,0h16.8c2,0,3.6,1.6,3.6,3.6v16.8c0,2-1.6,3.6-3.6,3.6H3.6c-2,0-3.6-1.6-3.6-3.6V3.6C0,1.6,1.6,0,3.6,0z"/>
        <path class="st1fdfdf" d="M16.7,15.5l0.5-3.5h-3.3V9.8c0-0.9,0.5-1.9,2-1.9h1.5v-3c0,0-1.4-0.2-2.7-0.2c-2.7,0-4.5,1.7-4.5,4.7V12h-3v3.5
        h3V24h3.7v-8.5H16.7z"/>
      </svg>

    </a>
    @endif
    @if ($restaurant->tripadvisor !== null && $restaurant->tripadvisor !== '')
    <a class="header-trip" href="{{ $restaurant->tripadvisor }}" target="_blank">
      <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_2_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 38.4 24" style="enable-background:new 0 0 38.4 24;" xml:space="preserve">
<style type="text/css">
  .st0212121212156{fill:#34E0A1;}
</style>
<path class="st0212121212156" d="M9.6,9.6c-2.7,0-4.8,2.2-4.8,4.8s2.2,4.8,4.8,4.8s4.8-2.2,4.8-4.8C14.4,11.7,12.3,9.6,9.6,9.6L9.6,9.6z
   M9.6,17.8c-1.9,0-3.4-1.5-3.4-3.4S7.7,11,9.6,11s3.4,1.5,3.4,3.4C13,16.3,11.5,17.8,9.6,17.8z"/>
<circle class="st0212121212156" cx="9.6" cy="14.4" r="2.4"/>
<path class="st0212121212156" d="M28.8,9.6c-2.7,0-4.8,2.2-4.8,4.8s2.2,4.8,4.8,4.8s4.8-2.2,4.8-4.8S31.5,9.6,28.8,9.6z M28.8,17.8
  c-1.9,0-3.4-1.5-3.4-3.4s1.5-3.4,3.4-3.4c1.9,0,3.4,1.5,3.4,3.4C32.2,16.3,30.7,17.8,28.8,17.8z"/>
<circle class="st0212121212156" cx="28.8" cy="14.4" r="2.4"/>
<path class="st0212121212156" d="M35.6,7.6l2.8-2.8h-5.7C29.4,2.2,24.1,0,19.2,0C14.2,0,8.9,2.2,5.7,4.8H0l2.8,2.8C1.1,9.3,0,11.7,0,14.4
  C0,19.7,4.3,24,9.6,24c2.4,0,4.7-0.9,6.4-2.4l3.3,2.4l3.2-2.3l0-0.1c1.7,1.5,3.9,2.4,6.4,2.4c5.3,0,9.6-4.3,9.6-9.6
  C38.4,11.7,37.3,9.3,35.6,7.6L35.6,7.6z M27.6,4.9c-4.5,0.6-8.1,4.3-8.4,9c-0.3-4.6-3.9-8.4-8.4-9c2.3-1.6,5.2-2.5,8.4-2.5
  S25.3,3.2,27.6,4.9z M9.6,21.6c-4,0-7.2-3.2-7.2-7.2s3.2-7.2,7.2-7.2s7.2,3.2,7.2,7.2C16.8,18.4,13.6,21.6,9.6,21.6z M28.8,21.6
  c-4,0-7.2-3.2-7.2-7.2s3.2-7.2,7.2-7.2s7.2,3.2,7.2,7.2C36,18.4,32.8,21.6,28.8,21.6z"/>
</svg>

    </a>
    @endif
    @if ($restaurant->website !== null && $restaurant->website !== '')
    <a class="header-website" href="{{ $restaurant->website }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
      height="24" viewBox="0 0 24 24">
      <path fill="currentColor"
      d="M16.36 14c.08-.66.14-1.32.14-2c0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2m-5.15 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 0 1-4.33 3.56M14.34 14H9.66c-.1-.66-.16-1.32-.16-2c0-.68.06-1.35.16-2h4.68c.09.65.16 1.32.16 2c0 .68-.07 1.34-.16 2M12 19.96c-.83-1.2-1.5-2.53-1.91-3.96h3.82c-.41 1.43-1.08 2.76-1.91 3.96M8 8H5.08A7.923 7.923 0 0 1 9.4 4.44C8.8 5.55 8.35 6.75 8 8m-2.92 8H8c.35 1.25.8 2.45 1.4 3.56A8.008 8.008 0 0 1 5.08 16m-.82-2C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2c0 .68.06 1.34.14 2M12 4.03c.83 1.2 1.5 2.54 1.91 3.97h-3.82c.41-1.43 1.08-2.77 1.91-3.97M18.92 8h-2.95a15.65 15.65 0 0 0-1.38-3.56c1.84.63 3.37 1.9 4.33 3.56M12 2C6.47 2 2 6.5 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2Z" />
    </svg></a>
    @endif
    @if ($restaurant->tiktok !== null && $restaurant->tiktok !== '')
    <a class="header-tiktok" href="{{ $restaurant->tiktok }}" target="_blank">


      <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 21.2 24" style="enable-background:new 0 0 21.2 24;" xml:space="preserve">
<style type="text/css">
  .st01212{fill:#EE1D52;}
  .st1kfjgkfglf{fill:#FFFFFF;}
  .st2gfjkfglkfgf{fill:#69C9D0;}
</style>
<g>
  <path class="st01212" d="M15.7,8.7c1.5,1.1,3.4,1.8,5.5,1.8V6.5c-0.4,0-0.8,0-1.2-0.1v3.1c-2.1,0-3.9-0.7-5.5-1.8v8
    c0,4-3.3,7.3-7.3,7.3c-1.5,0-2.9-0.5-4.1-1.2C4.6,23.2,6.4,24,8.4,24c4,0,7.3-3.3,7.3-7.3L15.7,8.7L15.7,8.7z M17.2,4.7
    c-0.8-0.9-1.3-2-1.4-3.2V1h-1.1C14.9,2.5,15.9,3.9,17.2,4.7L17.2,4.7z M5.8,18.7c-0.4-0.6-0.7-1.3-0.7-2c0-1.8,1.5-3.3,3.3-3.3
    c0.3,0,0.7,0.1,1,0.2v-4C9.1,9.4,8.7,9.4,8.3,9.4v3.1c-0.3-0.1-0.7-0.2-1-0.2c-1.8,0-3.3,1.5-3.3,3.3C3.9,17,4.7,18.2,5.8,18.7z"/>
  <path class="st1kfjgkfglf" d="M14.6,7.7c1.6,1.1,3.4,1.8,5.5,1.8V6.4c-1.1-0.2-2.2-0.8-2.9-1.7c-1.3-0.8-2.2-2.2-2.5-3.7h-2.9v15.8
    c0,1.8-1.5,3.3-3.3,3.3c-1.1,0-2-0.5-2.7-1.3c-1.1-0.5-1.8-1.7-1.8-3c0-1.8,1.5-3.3,3.3-3.3c0.4,0,0.7,0.1,1,0.2V9.4
    c-4,0.1-7.1,3.3-7.1,7.3c0,2,0.8,3.8,2.1,5.1C4.4,22.6,5.8,23,7.3,23c4,0,7.3-3.3,7.3-7.3L14.6,7.7z"/>
  <path class="st2gfjkfglkfgf" d="M20.1,6.4V5.5c-1,0-2-0.3-2.9-0.8C17.9,5.5,19,6.1,20.1,6.4z M14.6,1c0-0.2,0-0.3-0.1-0.5V0h-4v15.8
    c0,1.8-1.5,3.3-3.3,3.3c-0.5,0-1-0.1-1.5-0.4C6.4,19.5,7.4,20,8.4,20c1.8,0,3.3-1.5,3.3-3.3V1H14.6z M8.3,9.4V8.5
    c-0.3,0-0.7-0.1-1-0.1c-4,0-7.3,3.3-7.3,7.3c0,2.5,1.3,4.7,3.2,6.1c-1.3-1.3-2.1-3.1-2.1-5.1C1.2,12.7,4.3,9.5,8.3,9.4L8.3,9.4z"/>
</g>
</svg>


    </a>
    @endif

    @if ($restaurant->google_review_link !== null && $restaurant->google_review_link !== '')
    <a class="header-google_review_link" href="{{ $restaurant->google_review_link }}" target="_blank">



      <svg width="24px" height="24px" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/></svg>


    </a>
    @endif
  </div>






            </div>
            <div class="location">
                <p>{{ Illuminate\Support\Str::limit($restaurant->address, 45)}}</p>
            </div>
        </div>

</header>
<section class="restaurant-content">
    @if ($restaurant->content)
    <div class="restaurant-desc">
        <p><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <path fill="currentColor"
            d="M5.315 3.401c-1.61 0-2.916 1.343-2.916 3c0 1.656 1.306 3 2.916 3c2.915 0 .972 5.799-2.916 5.799v1.4c6.939.001 9.658-13.199 2.916-13.199zm8.4 0c-1.609 0-2.915 1.343-2.915 3c0 1.656 1.306 3 2.915 3c2.916 0 .973 5.799-2.915 5.799v1.4c6.938.001 9.657-13.199 2.915-13.199z" />
        </svg>{{ $restaurant->content }}</p>
    </div>
    @endif

    <h2 class="resto_cats_title">
            Nos catégories
        </h2>
        <!-- /.resto_cats_title -->


    <div class="resto_cats">



         @foreach ($categories as $category)
        <div class="resto_cat">
             <a class="full-link" href="{{ route('restaurant-products', [Str::slug($restaurant->name),$restaurant->id, $category->id]) }}"></a>
            <div class="resto_cat_img" style="background-image: url(@if ($category->image){{ $url }}images/{{ $restaurant->id }}/{{ $category->image }}@else{{ $url }}images/default.png);@endif" ></div>
            <h4 class="resto_cat_title">{{ $category->name }}</h4>
            <!-- /.wrap_cat -->
        </div>
        <!-- /.resto-cat -->
         @endforeach
    </div>
    <!-- /.resto-cats -->


    @if ($products->count() > 0)
    <div class="restaurant-products">
        <h2 class="title-point sub-title">A découvrir chez <span>{{ $restaurant->name }}</span></h2>
        <div class="after"></div>
        <!-- /.after -->
        <div class="product-list">
            @foreach ($products as $product)

            @if($product->active)
            <div class="product">
                 <a class="full-link"
                href="{{ route('restaurant-products', [Str::slug($restaurant->name),$restaurant->id, $product->categories[0]->id]) }}/#prod-{{ $product->id }}"></a>
                <figure>
                    @if ($product->image)
                    <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}"
                    alt="Image de la categorie {{ $product->name }}">
                    @else
                    <img src="{{ $url }}images/default.png" alt="Image par default">
                    @endif
                </figure>
                <h4 class="product_name">{{ $product->name }}</h4>
                <p class="product_price ">{{ $product->price }} €</p>
        </div>
          @endif
        @endforeach
    </div>
</div>
@endif
@if (
    $restaurant->lundi ||
    $restaurant->mardi ||
    $restaurant->mercredi ||
    $restaurant->jeudi ||
    $restaurant->vendredi ||
    $restaurant->samedi ||
    $restaurant->dimanche)
    <div class="restaurant-hours">
        <h2 class="title-point">Horaires<span class="after"></span>
        <!-- /.after --></h2>
        <div class="hours-container">
            <div class="hours">
                @if ($restaurant->lundi)
                <div class="hour">
                    <p>Lundi : </p>
                    <span class="dots"></span>
                    <!-- /.dots -->
                    <span>
                      @if ($restaurant->lundi == '-')
                      Fermé
                      @else
                      {{$restaurant->lundi}}
                      @endif
                    </span>
                </div>
                @endif

                @if ($restaurant->mardi)
                <div class="hour">
                    <p>Mardi : </p>
                    <span class="dots"></span>
                    <!-- /.dots -->
                    <span>
                      @if ($restaurant->mardi == '-')
                      Fermé
                      @else
                      {{$restaurant->mardi}}
                      @endif
                    </span>
                </div>
                @endif

                @if ($restaurant->mercredi)
                <div class="hour">
                    <p>Mercredi : </p>
                    <span class="dots"></span>
                    <!-- /.dots -->
                    <span>
                      @if ($restaurant->mercredi == '-')
                      Fermé
                      @else
                      {{$restaurant->mercredi}}
                      @endif
                    </span>
                </div>
                @endif

                @if ($restaurant->jeudi)
                <div class="hour">
                    <p>Jeudi : </p>
                    <span class="dots"></span>
                    <!-- /.dots -->
                    <span>
                      @if ($restaurant->jeudi == '-')
                      Fermé
                      @else
                      {{$restaurant->jeudi}}
                      @endif
                    </span>
                </div>
                @endif

                @if ($restaurant->vendredi)
                <div class="hour">
                    <p>Vendredi : </p>
                    <span class="dots"></span>
                    <!-- /.dots -->
                    <span>
                      @if ($restaurant->vendredi == '-')
                      Fermé
                      @else
                      {{$restaurant->vendredi}}
                      @endif
                    </span>
                </div>
                @endif

                @if ($restaurant->samedi)
                <div class="hour">
                    <p>Samedi : </p>
                    <span class="dots"></span>
                    <!-- /.dots -->
                    <span>
                      @if ($restaurant->samedi == '-')
                      Fermé
                      @else
                      {{$restaurant->samedi}}
                      @endif
                    </span>
                </div>
                @endif

                @if ($restaurant->dimanche)
                <div class="hour">
                    <p>Dimanche : </p>
                    <span class="dots"></span>
                    <!-- /.dots -->
                    <span>
                      @if ($restaurant->dimanche == '-')
                      Fermé
                      @else
                      {{$restaurant->dimanche}}
                      @endif
                    </span>
                </div>
                @endif

            </div>
        </div>
    </div>
    @endif
    <div class="restaurant-opinions">
        <div class="button">
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
        <div class="opinion-form-container">
            <div class="opinion-form">
                <svg class="close-form" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill="currentColor"
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93A10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34A8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83l-1.41 1.41L10 11.41l-2.83 2.83l-1.41-1.41L8.59 10L5.76 7.17l1.41-1.41L10 8.59l2.83-2.83l1.41 1.41z" />
                </svg>
                <figure>
                    <img src="{{ $url }}img/avis.jpg" alt="">
                </figure>
                <h3 class="title-point">Laisser votre avis sur {{ $restaurant->name }}</h3>
                <form action="{{ route('restaurant-opinion', $restaurant->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <p class="form-error"></p>
                    <div class="author">
                        <label for="author">Votre nom et prénom</label>
                        <input type="text" name="author" id="author">
                    </div>
                    <div class="email">
                        <label for="email">Votre addresse email</label>
                        <input type="email" name="email" id="email">
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
</div>
</section>
@include('partial.restaurant-footer')
<div class="map-container">
    <div class="map">
        <svg class="close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="currentColor"
            d="M2.93 17.07A10 10 0 1 1 17.07 2.93A10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34A8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83l-1.41 1.41L10 11.41l-2.83 2.83l-1.41-1.41L8.59 10L5.76 7.17l1.41-1.41L10 8.59l2.83-2.83l1.41 1.41z" />
        </svg>
        <iframe scrolling="no" marginheight="0" marginwidth="0"
        src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ $restaurant->address }}t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
        width="100%" height="600" frameborder="0"><a
        href="https://www.maps.ie/distance-area-calculator.html">area maps</a></iframe>
        <div class="address">
           <a href="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ $restaurant->address }}t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;" target="_blank"> {{$restaurant->address}} </a>
       </div>
   </div>
</div>
</section>

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
        form.style.display = 'flex'
    });
    document.querySelector('.close-form').addEventListener('click', () => {
        form.style.display = 'none'
    });
    document.querySelector('.open').addEventListener('click', () => {
        form.style.display = 'flex'
    });
</script>

<script>
    const map = document.querySelector('.map-container');
    document.querySelector('.location').addEventListener('click', () => {
        map.style.display = 'flex';
    });
    document.querySelector('.map-container').addEventListener('click', () => {
        map.style.display = 'none';
    });
    document.querySelector('.close').addEventListener('click', () => {
        map.style.display = 'none';
    });
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
