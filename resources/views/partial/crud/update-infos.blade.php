@if (auth()->check())
    @if ($user->id == $restaurant->admin_id)
        <!-- Modal -->
        <div class="modal fade" id="modal-update_logo" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier les informations de votre restaurant </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="prodForm" action="{{ route('updateInfos',  $restaurant->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <p>Le nom du restaurant</p>
                                    <input class="form-control" type="text" placeholder="Nom du Restaurant"
                                        name="name" value="{{ $restaurant->name }}">
                                    <hr />
                                </div>

                                <div class="form-group col-md-6">
                                    <p>Le numéro de téléphone du restaurant</p>
                                    <input class="form-control" type="text" placeholder="Téléphone" name="mobile"
                                        value="{{ $restaurant->mobile }}">
                                    <hr />
                                </div>

                                <div class="form-group col-md-12">
                                    <p>La description du restaurant</p>
                                    <textarea class="form-control" name="content" row="10" placeholder="Description du restaurant (accueil)">{{ $restaurant->content }}</textarea>
                                    <hr />
                                </div>
                                <div class="form-group col-md-6">
                                    <p>Lien facebook</p>
                                    <input class="form-control" type="text" placeholder="https://google.fr"
                                        name="facebook" value="{{ $restaurant->facebook }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-6">
                                    <p>Lien instagram</p>
                                    <input class="form-control" type="text" placeholder="https://google.fr"
                                        name="instagram" value="{{ $restaurant->instagram }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-6">
                                    <p>Lien du site</p>
                                    <input class="form-control" type="text" placeholder="https://google.fr"
                                        name="website" value="{{ $restaurant->website }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-6">
                                    <p>Lien tripadvisor</p>
                                    <input class="form-control" type="text" placeholder="https://google.fr"
                                        name="tripadvisor" value="{{ $restaurant->tripadvisor }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-6">
                                    <p>Lien tiktok</p>
                                    <input class="form-control" type="text" placeholder="https://google.fr"
                                        name="tiktok" value="{{ $restaurant->tiktok }}">
                                    <hr />
                                </div>
                                <div id="search" class="col-md-6">
                                    <!-- search -->

                                    <button style="display: none" type="button"
                                        onclick="adress_search();">Recherche</button>

                                    <div class="wrap_map"></div>
                                    <!-- /.wrap_map -->
									<p>Adresse</p>
                                    <input id="address" placeholder="Adresse" type="text" class="form-control"
                                        name="address" value="{{ $restaurant->address }}">
                                    <div class="wrap_results">
                                        <div id="results"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Hoaire du lundi</p>
                                    <input class="form-control" type="text" placeholder="9h - 17h" name="lundi"
                                        value="{{ $restaurant->lundi }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Hoaire du mardi</p>
                                    <input class="form-control" type="text" placeholder="9h - 17h" name="mardi"
                                        value="{{ $restaurant->mardi }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Hoaire du mercredi</p>
                                    <input class="form-control" type="text" placeholder="9h - 17h" name="mercredi"
                                        value="{{ $restaurant->mercredi }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Hoaire du jeudi</p>
                                    <input class="form-control" type="text" placeholder="9h - 17h" name="jeudi"
                                        value="{{ $restaurant->jeudi }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Hoaire du vendredi</p>
                                    <input class="form-control" type="text" placeholder="9h - 17h"
                                        name="vendredi" value="{{ $restaurant->vendredi }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Hoaire du samedi</p>
                                    <input class="form-control" type="text" placeholder="9h - 17h" name="samedi"
                                        value="{{ $restaurant->samedi }}">
                                    <hr />
                                </div>
                                <div class="form-group col-md-4">
                                    <p>Hoaire du dimanche</p>
                                    <input class="form-control" type="text" placeholder="9h - 17h"
                                        name="dimanche" value="{{ $restaurant->dimanche }}">
                                    <hr />
                                </div>
                                <input id="lat" placeholder="lat" type="text"
                                    class="form-control "name="lat" value="{{ $restaurant->lat }}">

                                <input id="lon" placeholder="lon" type="text" class="form-control "
                                    name="lon" value="{{ $restaurant->lon }}">


                                <div class="form-group col-md-12">
                                    <p>Le logo</p>
                                    <input class="form-control" type="file" name="image" value="">
                                    <hr />
                                </div>

                                <div class="form-group col-md-12">
                                    <p>La bannière</p>
                                    <input class="form-control" type="file" name="banner" value="">
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    @endif
@endif
