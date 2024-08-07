<section class="suggestions">
    <h2>Ici, retrouvez vos suggestions et envoyez nous de nouvelles suggestions qui permettrai d'améliorer MonMenu.io.
    </h2>
    @if (count($user->suggestions) > 0)
        <table class="col-12">
            <thead class="col-12">
                <tr>
                    <th class="col-3">
                        Titre
                    </th>
                    <th class="col-6">
                        Contenu
                    </th>
                    <th class="col-3">
                        Status
                    </th>
                </tr>
                <tr>
                    <th class="col-3">

                    </th>
                    <th class="col-6">

                    </th>
                    <th class="col-3">

                    </th>
                </tr>
            </thead>
            <tbody class="col-12">
                @foreach ($user->suggestions as $suggestion)
                    <tr style="border-bottom: 2px solid #8080802b;">
                        <th class="col-4">
                            {{ $suggestion->title }}
                        </th>
                        <th class="col-4">
                            {{ $suggestion->content }}
                        </th>
                        <th class="col-4">
                            @if ($suggestion->status == 'consideration')
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
                            @endif
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Vous n'avez fait aucune suggestion pour le moment ! Remplissez le formulaire ci-dessous si vous avez des
            choses à nous suggérer.</p>
    @endif
    <div class="suggestion-form" style="margin-top: 50px">
        <h3>Remplissez le formulaire si vous avez une suggestion à nous faire !</h3>
        <form action="{{route('submitSuggestion')}}" method="post">
            @csrf
            @method('post')
            <div class="form-group col-6">
                <label for="title">Titre de la suggestion</label>
                <input type="text" name="title" id="title" placeholder="Titre de la suggestion"
                    class="form-control" required>
            </div>
            <div class="form-group col-12">
                <label for="content">Contenu de la suggestion</label>
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Contenu de la suggestion"
                    class="form-control"></textarea>
            </div>
            <button class="btn btn-secondary">Envoyer</button>
        </form>
    </div>
</section>
