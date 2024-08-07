<?php
$url = config('app.url');
?>


@extends('layouts.app')

<style>
    .choose {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .choose-container {
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 15px;
        height: max-content;
    }

    .restaurant-list {
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        gap: 30px;
    }

    .restaurant {
        flex: 1;
        width: 150px;
    }

    .restaurant img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: contain;
        object-position: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 20px;

    }

    form button,
    form .item input {
        width: 300px;
        margin: auto;
    }

    form button,
    form input {
        padding: 10px;
        background-color: black;
        color: white;
        border-radius: 500px;
        border: 2px solid black;
        cursor: pointer;
    }

    form input {
        cursor: initial;
        padding: 10px;
        background-color: white;
        color: black;
        border-radius: 500px;
        border: 2px solid black;
    }
</style>
@section('content')
    <section class="choose">
        <div class="choose-container">
            <h1>Choisissez le restaurant que vous souhaitez gérer !</h1>
            <div class="restaurant-list">
                @foreach ($restaurants as $item)
                    <div class="restaurant">
                        @if ($item->logo)
                            <img src="{{ $url }}images/{{ $item->id }}/{{ $item->logo }}"
                                alt="Logo du restaurant {{ $item->name }}">
                        @else
                            <img src="{{ $url }}img/logo.png" alt="Logo du restaurant {{ $item->name }}"
                                style="object-fit: initial">
                        @endif
                        <h3>{{ $item->name }}</h3>
                        <a href="{{ route('single', ['restau_id' => $item->id]) }}">Choisir ce restaurant</a>
                    </div>
                @endforeach
            </div>
            <p>Si vous souhaitez créer un nouvel établissement, remplissez le formulaire !</p>

            <form method="post" action="{{ route('newRestau') }}">
                @csrf
                @method('POST')
                <div class="item">
                    <label for="name">Nom du nouveau restaurant</label>
                    <input type="text" id="name" name="name">
                </div>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </section>
    <script>
        document.querySelector('.new_restau').addEventListener('click', () => {
            console.log('salut');
        })
    </script>
@endsection
