<?php $url = config('app.url'); ?>
@extends('layouts.new-app')

@section('app-content')
    <div class="form-container">
        <div class="form">
            <h1><small>Bonjour {{ Auth::User()->name }} ! Bienvenue sur MonMenu.io</small></h1>
            <p>Afin d'accéder au panneau de controle de l'établissement, vous devez changer votre mot de passe provisoire !
            </p>
            @if (session('error'))
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
                <div class="alert alert-danger">
                    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    <span> {{ session('error') }}</span>
                </div>
            @endif
            <div class="form-section">
                <figure>
                    <img src="{{ $url }}img/vitrine/illustration-login.svg" alt="Illustration-connexion">
                </figure>
                <form method="POST" action="{{ route('changeSubAdminPassword') }}">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">Ancien mot de passe</label>
                        <input type="text" class="form-control" placeholder="Ancien mot de passe" name="old_password"
                            id="old_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nouveau mot de passe</label>
                        <input type="text" class="form-control" placeholder="Nouveau mot de passe" name="new_password"
                            id="new_password">
                    </div>
                    <button type="submit" class="btn mb-3 btn-primary">Changer mon mot de passe</button>

                </form>
            </div>
        </div>
    @endsection
