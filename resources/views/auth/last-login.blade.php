@extends('layouts.app')


@section('header-css')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


<style>
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap');

    .welcome_wrap{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction:column;
        height: calc(100vh - 30px);
    }
    h1,h2{
        color: #452f27;
    }

    body{
        background-image: url({{ asset("img/leather2.jpg" )}});
        border: 15px solid #452f27;
        font-family: 'Raleway';
        text-align: center;
        padding: 0;
    }

    .copy{
        position: fixed;
        bottom: 30px;
        right: 30px;
        font-size: 12px;
        color: #452f27;
    }

    .btn-danger{
        background-color: #452f27;
        border-color: #452f27;
    }


    span.logo{
        width: 150px;
        height: 150px;
        display: block;
    }

    @media(max-width:780px){
        h2{
            font-size: 22px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 25px;
        }
    }
    .btn-primary,
    .btn-primary:hover,
    .form-check-input:checked {
        background-color: #452f27;
        border-color: #452f27;
    }

    .btn-link{
        color: #452f27;
    }

    .card-header{
       background-color: #452f27;
       color: #fff;
   }




input#email,
input#password,
button.btn.btn-primary
{
    height:47px;
    border-radius:25px;
    border:none
}

a{
    color:#fff
}

a.btn.btn-link ,
label.form-check-label {
    color: #d3a868;
}

button.btn.btn-primary {
    width: 100%;
    background:#d3a868;
    color:#000
}


.mt-5 a {
    font-size: 14px;
}

div#app {
    height: auto!important;
}

.welcome_wrap {
}


</style>


@endsection

@section('content')
<div class="welcome_wrap">

    <div class="container">

<svg
 xmlns="http://www.w3.org/2000/svg"
 xmlns:xlink="http://www.w3.org/1999/xlink"
 width="9.596cm" height="2.575cm">
<path fill-rule="evenodd"  fill="rgb(211, 168, 104)"
 d="M247.027,68.222 C245.209,68.222 244.301,67.470 244.301,65.966 C244.301,64.462 244.974,62.676 246.322,60.608 C247.669,58.540 249.016,56.707 250.364,55.109 C251.711,53.511 252.385,52.556 252.385,52.242 C252.385,51.929 252.291,51.772 252.103,51.772 C246.275,55.658 242.812,58.039 241.716,58.916 C240.619,59.794 238.833,61.235 236.358,63.240 C233.882,65.246 232.269,66.499 231.517,67.000 C230.765,67.501 229.950,67.752 229.073,67.752 C228.195,67.752 227.757,67.376 227.757,66.624 C227.757,65.747 229.511,62.990 233.021,58.352 C236.405,53.715 238.097,51.114 238.097,50.550 C238.097,50.425 237.987,50.362 237.768,50.362 C237.586,50.362 235.699,51.672 232.116,54.282 C226.398,58.873 221.436,61.172 217.230,61.172 C216.728,61.172 216.352,61.141 216.102,61.078 C214.410,63.146 212.561,64.823 210.556,66.107 C208.550,67.391 206.796,68.034 205.292,68.034 C202.910,68.034 201.720,66.703 201.720,64.039 C201.720,62.786 202.232,61.327 203.217,59.678 C201.172,61.148 199.067,62.617 196.880,64.086 C192.775,66.844 190.190,68.222 189.125,68.222 C187.307,68.222 186.399,67.470 186.399,65.966 C186.399,64.149 187.965,60.718 191.099,55.673 C191.138,55.610 191.176,55.552 191.215,55.490 C181.118,63.539 174.780,67.564 172.206,67.564 C169.698,67.564 168.446,66.029 168.446,62.958 C168.446,62.394 168.507,61.486 168.634,60.232 C166.002,62.175 163.682,64.149 161.678,66.154 C160.926,66.781 160.423,67.094 160.174,67.094 C159.734,67.094 159.516,66.875 159.516,66.436 C159.516,66.186 159.828,65.747 160.456,65.120 C162.148,63.240 165.062,60.702 169.198,57.506 C169.605,55.653 169.911,54.210 170.115,53.175 C164.360,57.863 159.505,61.446 155.568,63.898 C151.244,66.593 147.327,67.940 143.818,67.940 C140.998,67.940 139.588,66.562 139.588,63.804 C139.588,61.458 140.297,59.074 141.670,56.655 C132.006,64.357 125.851,68.222 123.233,68.222 C121.415,68.222 120.507,67.470 120.507,65.966 C120.507,64.462 121.180,62.676 122.528,60.608 C123.875,58.540 125.222,56.707 126.570,55.109 C127.917,53.511 128.591,52.556 128.591,52.242 C128.591,51.929 128.497,51.772 128.309,51.772 C122.481,55.658 119.018,58.039 117.922,58.916 C116.825,59.794 115.039,61.235 112.564,63.240 C110.088,65.246 108.475,66.499 107.723,67.000 C106.971,67.501 106.156,67.752 105.279,67.752 C104.401,67.752 103.963,67.376 103.963,66.624 C103.963,65.747 105.717,62.990 109.227,58.352 C112.611,53.715 114.303,51.114 114.303,50.550 C114.303,50.425 114.193,50.362 113.974,50.362 C113.793,50.362 111.922,51.660 108.370,54.247 C96.977,63.555 89.829,68.222 86.951,68.222 C85.132,68.222 84.225,67.470 84.225,65.966 C84.225,64.462 84.897,62.676 86.246,60.608 C87.592,58.540 88.939,56.707 90.288,55.109 C91.634,53.511 92.309,52.556 92.309,52.242 C92.309,51.929 92.215,51.772 92.027,51.772 C86.199,55.658 82.735,58.039 81.640,58.916 C80.542,59.794 78.756,61.235 76.282,63.240 C73.805,65.246 72.193,66.499 71.441,67.000 C70.689,67.501 69.873,67.752 68.997,67.752 C68.118,67.752 67.681,67.376 67.681,66.624 C67.681,65.747 69.434,62.990 72.945,58.352 C76.329,53.715 78.021,51.114 78.021,50.550 C78.021,50.425 77.910,50.362 77.692,50.362 C77.510,50.362 75.623,51.672 72.040,54.282 C66.321,58.873 61.359,61.172 57.154,61.172 C56.651,61.172 56.275,61.141 56.026,61.078 C54.334,63.146 52.485,64.823 50.480,66.107 C48.473,67.391 46.720,68.034 45.216,68.034 C42.833,68.034 41.644,66.703 41.644,64.039 C41.644,61.376 43.867,57.820 48.318,53.370 C47.566,51.553 47.190,49.642 47.190,47.636 C47.190,45.631 47.909,44.002 49.352,42.748 C50.793,41.495 52.468,40.868 54.381,40.868 C56.292,40.868 57.906,41.495 59.222,42.748 C60.538,44.002 61.196,45.788 61.196,48.106 C61.196,51.678 60.035,55.250 57.718,58.822 C57.967,58.885 58.343,58.916 58.846,58.916 C61.803,58.916 65.252,57.508 69.189,54.704 L69.185,54.686 C73.633,51.114 76.641,48.827 78.209,47.824 C79.774,46.822 81.043,46.320 82.016,46.320 C82.986,46.320 83.473,46.790 83.473,47.730 C83.473,48.357 81.701,50.911 78.162,55.391 C74.620,59.872 72.851,62.285 72.851,62.629 C72.851,62.974 72.959,63.146 73.180,63.146 C73.398,63.146 76.970,60.624 83.896,55.579 C90.819,50.535 95.035,48.012 96.539,48.012 C96.976,48.012 97.399,48.185 97.808,48.529 C98.214,48.874 98.419,49.203 98.419,49.516 C98.419,50.268 96.757,52.759 93.437,56.989 C90.114,61.219 88.455,63.616 88.455,64.180 C88.455,64.744 88.845,65.026 89.630,65.026 C90.412,65.026 92.088,64.180 94.659,62.488 C98.524,59.964 102.120,57.371 105.476,54.719 L105.467,54.686 C106.658,53.730 107.737,52.874 108.721,52.102 L109.699,51.302 C109.789,51.238 109.877,51.184 109.965,51.133 C112.016,49.546 113.528,48.440 114.491,47.824 C116.057,46.822 117.326,46.320 118.298,46.320 C119.269,46.320 119.755,46.790 119.755,47.730 C119.755,48.357 117.984,50.911 114.444,55.391 C110.903,59.872 109.133,62.285 109.133,62.629 C109.133,62.974 109.242,63.146 109.462,63.146 C109.681,63.146 113.253,60.624 120.178,55.579 C127.102,50.535 131.317,48.012 132.821,48.012 C133.259,48.012 133.682,48.185 134.090,48.529 C134.497,48.874 134.701,49.203 134.701,49.516 C134.701,50.268 133.040,52.759 129.719,56.989 C126.397,61.219 124.737,63.616 124.737,64.180 C124.737,64.744 125.128,65.026 125.912,65.026 C126.695,65.026 128.371,64.180 130.941,62.488 C135.641,59.418 139.965,56.253 143.913,52.994 L145.085,52.035 C145.321,51.775 145.541,51.516 145.792,51.255 C149.928,46.963 153.406,44.816 156.226,44.816 C157.792,44.816 158.576,45.694 158.576,47.448 C158.262,50.895 153.312,55.532 143.724,61.360 L143.724,62.300 C143.724,64.368 144.805,65.402 146.967,65.402 C149.129,65.402 151.463,64.682 153.970,63.240 C158.858,60.358 163.432,57.068 167.694,53.370 L170.044,51.396 C170.161,51.312 170.276,51.241 170.389,51.180 C170.352,50.797 170.175,50.457 169.809,50.174 C169.400,49.861 169.198,49.626 169.198,49.469 C169.198,49.313 169.386,49.046 169.762,48.670 C171.454,47.480 172.643,46.884 173.334,46.884 C174.274,46.884 174.744,47.386 174.744,48.388 C174.744,48.890 174.241,50.895 173.240,54.404 C181.009,48.764 185.521,45.944 186.776,45.944 C187.152,45.944 187.495,46.117 187.810,46.461 C188.122,46.806 188.280,47.104 188.280,47.354 C188.280,47.480 186.776,48.388 183.768,50.080 C180.760,51.772 177.030,54.185 172.582,57.318 C172.142,59.324 171.924,60.890 171.924,62.018 C171.924,64.086 172.455,65.120 173.522,65.120 C174.335,65.120 177.000,63.742 181.512,60.984 C185.145,58.478 188.750,55.783 192.322,52.900 L193.829,51.631 C195.600,49.283 196.977,48.106 197.961,48.106 C199.026,48.106 199.559,48.514 199.559,49.328 C199.559,50.143 198.117,52.368 195.235,56.002 C192.352,59.637 190.911,62.238 190.911,63.804 C190.911,64.682 191.240,65.120 191.898,65.120 C192.556,65.120 194.201,64.243 196.833,62.488 C200.049,60.345 203.074,58.185 205.938,56.013 C206.669,55.167 207.472,54.292 208.394,53.370 C207.642,51.553 207.266,49.642 207.266,47.636 C207.266,45.631 207.986,44.002 209.428,42.748 C210.869,41.495 212.545,40.868 214.457,40.868 C216.368,40.868 217.982,41.495 219.298,42.748 C220.614,44.002 221.272,45.788 221.272,48.106 C221.272,51.678 220.112,55.250 217.794,58.822 C218.044,58.885 218.420,58.916 218.922,58.916 C221.880,58.916 225.329,57.508 229.266,54.704 L229.261,54.686 C233.710,51.114 236.718,48.827 238.285,47.824 C239.851,46.822 241.120,46.320 242.092,46.320 C243.063,46.320 243.549,46.790 243.549,47.730 C243.549,48.357 241.778,50.911 238.238,55.391 C234.697,59.872 232.927,62.285 232.927,62.629 C232.927,62.974 233.036,63.146 233.256,63.146 C233.475,63.146 237.047,60.624 243.972,55.579 C250.896,50.535 255.111,48.012 256.615,48.012 C257.053,48.012 257.476,48.185 257.884,48.529 C258.291,48.874 258.495,49.203 258.495,49.516 C258.495,50.268 256.834,52.759 253.513,56.989 C250.191,61.219 248.531,63.616 248.531,64.180 C248.531,64.744 248.922,65.026 249.706,65.026 C250.489,65.026 252.165,64.180 254.735,62.488 C259.435,59.418 263.759,56.253 267.707,52.994 L269.775,51.302 C270.213,50.989 270.621,50.832 270.997,50.832 C271.373,50.832 271.561,51.020 271.561,51.396 L271.561,51.678 C258.338,62.708 250.160,68.222 247.027,68.222 ZM45.498,63.522 C45.498,64.776 46.311,65.402 47.942,65.402 C49.571,65.402 51.639,63.742 54.146,60.420 C52.454,59.543 50.950,58.008 49.634,55.814 C46.875,58.822 45.498,61.392 45.498,63.522 ZM58.752,49.657 C58.752,47.370 58.188,45.678 57.060,44.581 C55.932,43.485 54.835,42.936 53.770,42.936 C51.575,42.936 50.480,44.064 50.480,46.320 C50.480,48.576 50.981,50.817 51.984,53.041 C52.985,55.266 54.271,56.911 55.838,57.976 C57.779,54.718 58.752,51.945 58.752,49.657 ZM151.714,53.323 C153.782,51.287 154.816,49.845 154.816,48.999 C154.816,48.153 154.471,47.730 153.782,47.730 C152.403,47.730 150.633,48.890 148.471,51.208 C146.309,53.527 144.852,56.159 144.100,59.104 C147.108,57.287 149.646,55.360 151.714,53.323 ZM205.574,63.522 C205.574,64.776 206.388,65.402 208.018,65.402 C209.647,65.402 211.715,63.742 214.222,60.420 C212.530,59.543 211.026,58.008 209.710,55.814 C206.952,58.822 205.574,61.392 205.574,63.522 ZM218.828,49.657 C218.828,47.370 218.264,45.678 217.136,44.581 C216.008,43.485 214.911,42.936 213.846,42.936 C211.652,42.936 210.556,44.064 210.556,46.320 C210.556,48.093 210.877,49.857 211.497,51.610 L211.873,51.302 C212.374,50.989 212.766,50.832 213.048,50.832 C213.330,50.832 213.471,51.020 213.471,51.396 L213.471,51.678 C213.612,51.678 213.121,52.130 212.045,53.001 C212.051,53.014 212.054,53.028 212.060,53.041 C213.062,55.266 214.347,56.911 215.914,57.976 C217.856,54.718 218.828,51.945 218.828,49.657 ZM202.191,45.004 C201.501,45.004 201.000,44.801 200.687,44.393 C200.373,43.986 200.217,43.516 200.217,42.983 C200.217,42.451 200.718,41.589 201.721,40.398 C202.723,39.208 203.522,38.612 204.118,38.612 C204.713,38.612 205.183,38.800 205.528,39.176 C205.872,39.552 206.045,40.085 206.045,40.774 C206.045,41.464 205.575,42.341 204.635,43.406 C203.695,44.472 202.880,45.004 202.191,45.004 ZM43.712,22.632 C36.693,26.455 29.800,29.494 23.032,31.750 C17.956,37.641 13.851,43.344 10.718,48.858 C7.584,54.373 6.018,58.916 6.018,62.488 C6.018,67.501 9.214,70.008 15.606,70.008 C19.178,70.008 23.126,68.880 27.450,66.624 C31.774,64.368 35.346,62.144 38.166,59.950 C38.792,59.512 39.341,59.292 39.811,59.292 C40.281,59.292 40.516,59.543 40.516,60.044 C40.516,60.358 40.390,60.640 40.140,60.890 C37.194,63.021 34.578,64.776 32.291,66.154 C30.003,67.532 27.011,68.895 23.314,70.243 C19.616,71.590 16.076,72.264 12.692,72.264 C4.796,72.264 0.848,69.224 0.848,63.146 C0.848,55.814 5.924,46.007 16.076,33.724 C13.068,34.476 10.185,34.946 7.428,35.134 C6.676,35.009 6.300,34.602 6.300,33.912 C6.300,33.223 6.644,32.847 7.334,32.784 C10.655,32.784 14.290,32.252 18.238,31.186 C25.632,22.726 33.513,15.567 41.879,9.707 C50.245,3.848 57.310,0.918 63.076,0.918 C65.958,0.918 67.400,1.639 67.400,3.080 C67.400,5.023 65.206,7.812 60.820,11.446 C56.433,15.081 50.730,18.810 43.712,22.632 ZM60.162,3.550 C56.464,3.550 51.341,6.010 44.793,10.929 C38.244,15.849 31.774,21.880 25.382,29.024 C31.210,26.956 37.085,24.246 43.007,20.893 C48.929,17.541 53.676,14.376 57.248,11.399 C60.820,8.423 62.606,6.245 62.606,4.866 C62.606,3.989 61.791,3.550 60.162,3.550 Z"/>
</svg>


        <div class="row justify-content-center">
            <div class="col-md-8">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf


                                    <input id="email" placeholder="Votre Email" type="email" class="form-control mb-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <input id="password" placeholder="Mot de passe" type="password" class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value="">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked="checked" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Se souvenir de moi') }}
                                        </label>
                                    </div>



                                    <button type="submit" class="btn mb-3 btn-primary">
                                        {{ __('Connexion') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié') }}
                                    </a>
                                    @endif

                        </form>

                        <div class="mt-5">

                            <a href="{{route('register')}}" class="">
                                {{ __('Pas encore de compte ?') }}
                            </a>
                        </div>

            </div>
        </div>
    </div>
    @endsection