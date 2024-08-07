<div class="col-12" style="margin-top: 50px">

    <div class="col-12 add-admin">

        <h3 class="text-center">Ajouter des administrateurs a mon établissement <strong>{{ $restaurant->name }}</strong>

        </h3>

        <form method="post" action="{{ route('addAdmin') }}" style="display: flex; align-items: end; gap:15px;"

            class="add-admin-form">

            @csrf

            @method('POST')

            <div class="form-group">

                <label for="name">Nom</label>

                <input type="text" id="name" name="name" required class="form-control">

            </div>

            <div class="form-group">

                <label for="email">E-mail</label>

                <input type="email" id="email" name="email" required class="form-control">

            </div>

            <div class="form-group">

                <label for="password">Mot de passe</label>

                <input type="password" id="password" name="password" required class="form-control">

            </div>

            <input type="text" name="restaurant_id" value="{{ $restaurant->id }}" style="display: none">

            <button type="submit" class="btn btn-secondary">Ajouter</button>

        </form>

    </div>

    @if (!empty($adminsList) && count($adminsList) >= 1)

    <section class="admin-list" style="margin: 50px 0">

        <h3 class="text-center">Voici la liste des administrateurs de votre établissement

            <strong>{{ $restaurant->name }}</strong>

        </h3>

        <table class="col-12">

            <thead class="col-12">

                <tr class="col-12">



                    <th class="col-4">

                        <strong>Nom</strong>

                    </th>

                    <th class="col-4">

                        <strong>Email</strong>

                    </th>

                    <th class="col-4"></th>

                </tr>

            </thead>

            <tbody>

                @foreach ($adminsList as $admin)

                @if ($restaurant->admin_id !== $admin->id)      

                <tr>

                    <th class="col-4">{{ $admin->name }}</th>

                        <th class="col-4">{{ $admin->email }}</th>

                        <th class="text-danger col-4">

                            <form id="delete-form-{{ $admin->id }}"

                                action="{{ route('deleteAdmin', $admin->id) }}" method="POST"

                                enctype="multipart/form-data" class="delete-form ml-4"

                                style="display:inline-flex; gap:5px;">

                                @csrf

                                @method('delete')

                                <small>

                                    <a class="text-danger"

                                    onclick="confirmDelete({{ $admin->id }}, '{{ $admin->name }}' )">

                                        <i class="tim-icons icon-trash-simple"></i>

                                    </a>

                                </small>

                            </form>

                            <script>

                                function confirmDelete(adminId, adminName) {

                                    if (confirm("Êtes-vous sûr de vouloir supprimer cet administrateur ( " + adminName + "    " + adminId +

                                            "  ) ?")) {

                                        document.getElementById('delete-form-' + adminId).submit();

                                    }

                                }

                                </script>

                        </th>

                    </tr>

                    @endif

                @endforeach

            </tbody>

        </table>

    </section>

    @else

    <h5 class="text-center">Votre établissement

        <strong>{{ $restaurant->name }}</strong> n'a aucun administrateur. Remplissez le formulaire ci-dessus pour ajouter une administrateur.

    </h5>

    @endif

    <h2 style="margin-top: 50px">Si vous souhaitez créer un nouvel établissement, remplissez le formulaire !</h2>

    <form method="post" action="{{ route('newRestau') }}" style="display: flex; align-items: end; gap:15px;">

        @csrf

        @method('POST')

        <div class="item form-group" style="display: flex; flex-direction:column; justify-content:center; ">

            <label for="name">Nom</label>

            <input type="text" id="name" name="name" class="form-control" required>

            <button type="submit" style="height: max-content;margin:10px" class="btn btn-secondary">Ajouter</button>

        </div>

    </form>

    <section class="choose col-12">

        <div class="choose-container">

            <h2>Voici la liste de vos etablissements</h2>

            <p>Vous ne pouvez pas supprimer votre établissement principal, si vous souhaitez supprimer votre

                établissement principal veuillez nous contacter !</p>

            <div class="restaurant-list">

                @foreach ($restaurants as $item)

                    <div class="restaurant">

                        @if ($item->logo)

                            <img src="{{ $url }}images/{{ $item->id }}/{{ $item->logo }}"

                                alt="Logo du restaurant {{ $item->name }}">

                        @else

                            <img src="{{ $url }}img/logo.png" alt="Logo du restaurant {{ $item->name }}">

                        @endif

                        <h3>{{ $item->name }}</h3>

                        @if ($item->id !== Auth::User()->restaurant_id)

                            <a href="{{ route('deleteRestaurant', ['id' => $item->id]) }}"

                                onclick="event.preventDefault();

                                     if (confirm('Voulez-vous vraiment supprimer cet établissement ?')) {

                                         document.getElementById('delete-form-{{ $item->id }}').submit();

                                        }">

                                Supprimer cet établissement

                            </a>

                            <form id="delete-form-{{ $item->id }}"

                                action="{{ route('deleteRestaurant', ['id' => $item->id]) }}" method="POST"

                                style="display: none;">

                                @csrf

                                @method('DELETE')

                            </form>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>

    </section>

</div>

<style>

    .add-admin-form {

        display: flex;

        flex-wrap: wrap;

        justify-content: center;

        align-items: center;

        gap: 10px;

    }



    .add-admin-form .form-control {

        width: 250px;

        flex: 1;

    }



    .add-admin-form .btn {

        width: 150px;

        flex: 1;

    }

</style>

