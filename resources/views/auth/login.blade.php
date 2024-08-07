<?php $url = config('app.url'); ?>
@extends('layouts.new-app')

@section('app-content')

<style>
    .header .navbar{
        display: none;
    }

ul#primary-menu {
    display: flex;
    gap: 20px;
}

ul#primary-menu a {
    text-decoration: none;
}

@media(max-width:830px){
   .vitrine .header .container
    {
        flex-direction:column;

    }

ul#primary-menu{
    margin-top:25px;
    font-size:14px
}


}


</style>

<link rel="stylesheet" href="https://monmenu.io/wp-content/themes/monmenu/style.css">

<div id="headeracharger" style="display: none;"></div>
<!-- /#headeracharger -->


    <div class="form-container">
        <div class="form">
            <h1>Connexion à votre compte</h1>
            <div class="form-section">
                <figure>
                    <img src="{{ $url }}img/vitrine/illustration-login.svg" alt="Illustration-connexion">
                </figure>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-input-container">

                        <input id="email" placeholder="Votre Email" type="email"
                            class="form-control mb-3 @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input id="password" placeholder="Mot de passe" type="password"
                            class="form-control mb-3 @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" value="">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" checked="checked"
                            {{ old('remember') ? 'checked' : '' }}>

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
            </div>
            <a href="{{ route('register') }}" class="">
                {{ __('Pas encore de compte ?') }}
            </a>
        </div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $('.header').load('https://monmenu.io/ .header .container', function () {
       $('.header .navbar').css('display', 'flex');
    });
</script>



    @endsection
