<?php $url = config('app.url'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MonMenu.io - Panel administrateur</title>
    <link rel="stylesheet" href="{{ $url }}styles/css/vitrine.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ $url }}dashboard-assets/css/nucleo-icons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <main class="admin_panel">
                    <h1>Salut {{ Auth::User()->name }} !</h1>
                    <p>Choisis le restaurant que tu souhaites voir ou gérer</p>
                    <section class="admin_restaurant_list">
                        @foreach ($restaurants as $restaurant)
                            <div class="admin-restaurant">
                                <a href="{{ route('single', ['restau_id' => $restaurant->id]) }}">
                                    @if ($restaurant->logo)
                                        <img style="width: 150px;height:150px;object-fit:cover; display:block;"
                                            src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->logo }}">
                                    @else
                                        <img style="width: 150px;height:150px;object-fit:cover; display:block;"
                                            src="{{ $url }}images/default.png">
                                    @endif
                                    <p>{{ $restaurant->name }}</p>
                                </a>
                            </div>
                        @endforeach
                    </section>
                    <h2>Voici les suggestions des utilisateurs de MonMenu</h2>
                    <div class="row w-100">
                        <div class="col-3">
                            <button class="btn btn-info w-100 filter-suggestion-btn" data-open="tr-consideration">
                                A l'etudes
                            </button>
                        </div>
                        <!-- /.col-4 -->
                        <div class="col-3">
                            <button class="btn btn-warning w-100 filter-suggestion-btn" data-open="tr-progress">
                                En cours
                            </button>
                        </div>
                        <!-- /.col-4 -->
                        <div class="col-3">
                            <button class="btn btn-success w-100 filter-suggestion-btn" data-open="tr-validate">
                                Terminés
                            </button>
                        </div>
                        <!-- /.col-3 -->
                        <div class="col-3">
                            <button class="btn btn-danger w-100 filter-suggestion-btn" data-open="tr-reject">
                                Refusés
                            </button>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (count($suggestions) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Utilisateur
                                        </th>
                                        <th>
                                            Titre
                                        </th>
                                        <th>
                                            Contenu
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suggestions as $suggestion)
                                        <tr class="tr-suggestion tr-{{ $suggestion->status }}">
                                            <td>
                                                {{ $suggestion->user->name }}
                                            </td>
                                            <td>
                                                {{ $suggestion->title }}
                                            </td>
                                            <td>
                                                {{ $suggestion->content }}
                                            </td>
                                            <td>
                                                {{-- @if ($suggestion->status == 'consideration')
                                                    <p class="text-warning">A l'étude</p>
                                                @endif
                                                @if ($suggestion->status == 'reject')
                                                    <p class="text-danger">Refuser</p>
                                                @endif
                                                @if ($suggestion->status == 'validate')
                                                    <p class="text-info">Effectué</p>
                                                @endif
                                                @if ($suggestion->status == 'progress')
                                                    <p class="text-success">En cours</p>
                                                @endif --}}
                                                <form action="{{ route('updateSuggesstionStatus', $suggestion->id) }}"
                                                    id="edit-sugg-{{ $suggestion->id }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <select name="status" id="status"
                                                        data-id="{{ $suggestion->id }}" class="form-control">
                                                        <option value="consideration"
                                                            @if ($suggestion->status == 'consideration') selected="selected" @endif>
                                                            A l'etude</option>
                                                        <option value="progress"
                                                            @if ($suggestion->status == 'progress') selected="selected" @endif>
                                                            En
                                                            cours</option>
                                                        <option value="validate"
                                                            @if ($suggestion->status == 'validate') selected="selected" @endif>
                                                            Terminé</option>
                                                        <option value="reject"
                                                            @if ($suggestion->status == 'reject') selected="selected" @endif>
                                                            Refusé</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td><a href="mailto:{{ $suggestion->user->email }}?subject=A propos de votre suggestion {{$suggestion->title}} sur MonMenu&body=Bonjour {{ $suggestion->user->name }}, merci de faire confiance à MonMenu !">Répondre</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Aucune suggestion pour le moment !</p>
                    @endif
                </main>
            </div>
        </div>
    </div>
    <script>
        const selects = document.querySelectorAll('select');

        selects.forEach(select => {
            select.addEventListener('input', (e) => {
                const id = e.target.getAttribute('data-id');
                document.querySelector('#edit-sugg-' + id).submit();
            })
        });

        var filterButtons = document.querySelectorAll('.filter-suggestion-btn');

        filterButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                var trToOpen = this.getAttribute('data-open');

                var demandeRows = document.querySelectorAll('.tr-suggestion');

                demandeRows.forEach(function(row) {
                    row.style.display = 'none';
                });

                var trToOpenRows = document.querySelectorAll('.tr-suggestion.' + trToOpen);
                trToOpenRows.forEach(function(row) {
                    row.style.display = '';
                });
            });
        });
    </script>
</body>

</html>
