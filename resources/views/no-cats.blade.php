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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./build/assets/app.css">
    <style>
        .no-cats {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .title {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
            align-items: center;
            max-width: 850px;
            color: white;
            text-align: center;
        }

        .add-cat {
            border-radius: 500px;
            padding: 10px;
            background-color: #D3A868;
        }

        .title h1 {
            font-size: 32px;
        }

        .title h2 {
            font-size: 28px;
        }
    </style>
    <section class="no-cats">
        <div class="title">
            <img class="logo" src="{{ $url }}img/logo-4.svg" alt="" style="width: 189px;">
            <h2>Bienvenue et merci d'utilisez MonMenu.io pour mettre en ligne le menu de votre établissement !</h2>
            <p>Cliquez sur le bouton ci-dessous pour ajouter votre première catégorie et commencez à remplir votre menu.</p>
            <a class="add-cat" href="#" title="" data-toggle="modal" data-target="#modal_category_add_1"><i
                    class="fa fa-plus"></i>
                Ajouter ma première catégorie</a>
        </div>
    </section>
    <div class="modal fade" id="modal_category_add_1" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- header -->
                    <h5 class="modal-title">Ajouter une catégorie </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- header -->
                <form id="catForm" action="{{ route('createcat') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nom de la catégorie</label>
                            <input type="text" class="form-control" id="name" placeholder="Nom de la catégorie"
                                name="name">
                        </div>
                        <div class="form-group mt-4">
                            <img id="imagePreview" src="#" alt="Aperçu de l'image" class="mb-4"
                                style="display: none;width: 100%;">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>

                        </div>
                        <input type="hidden" name="is_main" value="1">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter ma première
                            catégorie</button>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection
