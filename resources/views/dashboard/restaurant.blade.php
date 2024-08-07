<?php
$show = $_GET['show'];
?>
<style>
    @if ($show == 'base')

        .socials,
        .hours {
            display: none;
        }
    @elseif($show == 'social')
        .base,
        .hours {
            display: none;
        }
    @else
        .socials,
        .base {
            display: none;
        }
    @endif
</style>

<div class="card">
    <div class="card-header">
        <h5 class="title">Modifier
            @if ($show == 'base')
                <span class="info_title">les informations</span>
            @elseif($show == 'social')
                <span class="info_title">les réseaux sociaux</span>
            @else
                <span class="info_title">les horaires</span>
            @endif
            de mon restaurant
        </h5>
        <div id="updateresto"></div>
        <!-- /#updateresto -->
    </div>



    <div class="card-body">


        <div class="col-12 pb-5" style="padding: 0;">


            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-sm btn-primary btn-simple @if ($show == 'base') active @endif"
                    id="0">
                    <input type="radio" name="options" id="radio-resto" checked="">
                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Restaurant</span>
                    <span class="d-block d-sm-none">


                        <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 18H21M12 6V4M4 15V14C4 9.58172 7.58172 6 12 6V6C16.4183 6 20 9.58172 20 14V15H4Z"
                                stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="d-block text-center" style="font-size: 10px;">
                            Restaurant
                        </span>
                        <!-- /.d-block text-center -->



                    </span>
                </label>
                <label class="btn btn-sm btn-primary btn-simple @if ($show == 'social') active @endif"
                    id="1">
                    <input type="radio" class="d-none d-sm-none" name="options" id="radio-social">
                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Réseaux sociaux</span>
                    <span class="d-block d-sm-none">
                        <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M14 5C13.4477 5 13 5.44772 13 6C13 6.27642 13.1108 6.52505 13.2929 6.70711C13.475 6.88917 13.7236 7 14 7C14.5523 7 15 6.55228 15 6C15 5.44772 14.5523 5 14 5ZM11 6C11 4.34315 12.3431 3 14 3C15.6569 3 17 4.34315 17 6C17 7.65685 15.6569 9 14 9C13.5372 9 13.0984 8.8948 12.7068 8.70744L10.7074 10.7068C10.8948 11.0984 11 11.5372 11 12C11 12.4628 10.8948 12.9016 10.7074 13.2932L12.7068 15.2926C13.0984 15.1052 13.5372 15 14 15C15.6569 15 17 16.3431 17 18C17 19.6569 15.6569 21 14 21C12.3431 21 11 19.6569 11 18C11 17.5372 11.1052 17.0984 11.2926 16.7068L9.29323 14.7074C8.90157 14.8948 8.46277 15 8 15C6.34315 15 5 13.6569 5 12C5 10.3431 6.34315 9 8 9C8.46277 9 8.90157 9.1052 9.29323 9.29256L11.2926 7.29323C11.1052 6.90157 11 6.46277 11 6ZM8 11C7.44772 11 7 11.4477 7 12C7 12.5523 7.44772 13 8 13C8.27642 13 8.52505 12.8892 8.70711 12.7071C8.88917 12.525 9 12.2764 9 12C9 11.7236 8.88917 11.475 8.70711 11.2929C8.52505 11.1108 8.27642 11 8 11ZM14 17C13.7236 17 13.475 17.1108 13.2929 17.2929C13.1108 17.475 13 17.7236 13 18C13 18.5523 13.4477 19 14 19C14.5523 19 15 18.5523 15 18C15 17.4477 14.5523 17 14 17Z"
                                fill="#fff" />
                        </svg>
                        <span class="d-block text-center" style="font-size: 10px;">
                            Réseaux sociaux
                        </span>
                        <!-- /.d-block text-center -->
                    </span>
                </label>
                <label class="btn btn-sm btn-primary btn-simple @if ($show == 'hours') active @endif"
                    id="2">
                    <input type="radio" class="d-none" name="options" id="radio-hours">
                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Horaires</span>
                    <span class="d-block d-sm-none">
                        <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="1.5" />
                            <path d="M12 8V12L14.5 14.5" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="d-block text-center" style="font-size: 10px;">
                            Horaires
                        </span>
                        <!-- /.d-block text-center -->
                    </span>
                </label>
            </div>

        </div>
        <!-- /.col-12 -->






        <form id="prodForm" action="{{ route('updateInfos', $restaurant->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="base">
                <div class="row">

                    <div class="col-12 mt-3 mb-3">
                        <span class="qr_code">
                            {!! $qrCode !!}
                            <a href="admin?task=restaurant&show=base&download=true">Télécharger le QR Code vers mon
                                restaurant</a>
                            <br>
                            Mon restaurant :
                            <br>
                            <b
                                style="font-size: 10px;">{{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}</b>
                        </span>
                        <!-- /.qr_code -->


                        <h5 class="sharebtn btn btn-fill btn-primary">Partagez mon restaurant <svg class="ml-3"
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-share" viewBox="0 0 16 16">
                                <path
                                    d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                            </svg></h5>

                        <div class="sharings"
                            style="justify-content: start;font-size: 20px;flex-wrap: wrap;display: none;">
                            <hr>

                            <hr>
                            <span class="sharing sharing-fb " style="margin-right: 10px;">
                                <a class="submit_share"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}&t=Retrouvez moi sur monmenu.io"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"target="_blank"
                                    title="Partager sur Facebook">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                            </span>
                            <span class="sharing sharing-tw" style="margin-right: 10px;">
                                <a class="submit_share" data-media="Twitter icone"
                                    href="https://twitter.com/share?url={{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}&via=monmenu.io&text=Retrouvez moi sur monmenu.io"onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"target="_blank"
                                    title="Partager  sur Twitter">
                                    <i class="fab fa-twitter-square"></i>
                                </a>
                            </span>

                            <span class="sharing sharing-wa" style="">
                                <a class="submit_share" data-media="Whatsapp icone"
                                    href="https://wa.me/?text=Retrouvez moi sur monmenu.io -- {{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}"
                                    target="_blank" title="Partager sur Whatsapp">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path
                                            d="M224 122.8c-72.7 0-131.8 59.1-131.9 131.8 0 24.9 7 49.2 20.2 70.1l3.1 5-13.3 48.6 49.9-13.1 4.8 2.9c20.2 12 43.4 18.4 67.1 18.4h.1c72.6 0 133.3-59.1 133.3-131.8 0-35.2-15.2-68.3-40.1-93.2-25-25-58-38.7-93.2-38.7zm77.5 188.4c-3.3 9.3-19.1 17.7-26.7 18.8-12.6 1.9-22.4.9-47.5-9.9-39.7-17.2-65.7-57.2-67.7-59.8-2-2.6-16.2-21.5-16.2-41s10.2-29.1 13.9-33.1c3.6-4 7.9-5 10.6-5 2.6 0 5.3 0 7.6.1 2.4.1 5.7-.9 8.9 6.8 3.3 7.9 11.2 27.4 12.2 29.4s1.7 4.3.3 6.9c-7.6 15.2-15.7 14.6-11.6 21.6 15.3 26.3 30.6 35.4 53.9 47.1 4 2 6.3 1.7 8.6-1 2.3-2.6 9.9-11.6 12.5-15.5 2.6-4 5.3-3.3 8.9-2 3.6 1.3 23.1 10.9 27.1 12.9s6.6 3 7.6 4.6c.9 1.9.9 9.9-2.4 19.1zM400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM223.9 413.2c-26.6 0-52.7-6.7-75.8-19.3L64 416l22.5-82.2c-13.9-24-21.2-51.3-21.2-79.3C65.4 167.1 136.5 96 223.9 96c42.4 0 82.2 16.5 112.2 46.5 29.9 30 47.9 69.8 47.9 112.2 0 87.4-72.7 158.5-160.1 158.5z" />
                                    </svg>
                                </a>
                            </span>
                            <span class="sharing sharing-lkd" style="">
                                <a class="submit_share"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}&title=&summary=Retrouvez moi sur monmenu.io"
                                    target="_blank" title="Partager sur Linkedin">
                                    <i class="fab fa-linkedin" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>



                    </div>
                    <!-- /.col-12 mt-3 mb-3 -->


                    <div class="col-md-6 pr-md-1"> <!-- col-md-6 -->
                        <div class="form-group">
                            <label>Le nom du restaurant</label>
                            <input name="name" type="text" class="form-control"
                                placeholder="Le nom du restaurant" value="{{ $restaurant->name }}">
                        </div>
                    </div> <!-- col-md-6 -->

                    <div class="col-md-6"> <!-- col-md-6 -->
                        <div class="form-group">
                            <label>Le numéro de téléphone du restaurant</label>
                            <input type="text" class="form-control" placeholder="Téléphone" name="mobile"
                                value="{{ $restaurant->mobile }}">
                        </div>
                    </div> <!-- col-md-6 -->


                    <div class="col-md-12"> <!-- col-md-12 -->
                        <div class="form-group">
                            <label>La description du restaurant</label>
                            <textarea name="content" rows="4" cols="80" class="form-control"
                                placeholder="La description du restaurant">{{ $restaurant->content }}</textarea>
                        </div>
                    </div> <!-- col-md-12 -->


                    <div class="col-md-12"> <!-- col-md-12 -->
                        <div class="form-group">


                            <div class="row mb-4">
                                <div class="col-12">
                                    <h4>La Wifi du restaurant</h4>
                                </div>
                                <!-- /.col-12 -->
                                <div class="col-4">
                                    <input type="text" name="wifiSsid" class="form-control"
                                        placeholder="Wifi SSID" value="{{ $wifiSsid }}">
                                </div>
                                <div class="col-4">
                                    <input type="text" name="wifiPassword" class="form-control"
                                        placeholder="Mot de passe Wifi" value="{{ $wifiPassword }}">
                                </div>
                                <div class="col-4">
                                    <select class="form-control" name="wifiEncryption" id="">
                                        <option @if ($wifiEncryption == 'WPA') selected="selected" @endif
                                            value="WPA">WPA</option>
                                        <option @if ($wifiEncryption == 'WEP') selected="selected" @endif
                                            value="WEP">WEP</option>
                                        <option @if ($wifiEncryption == 'nopass') selected="selected" @endif
                                            value="nopass">nopass</option>
                                    </select>
                                    <!-- /# -->
                                </div>
                                <!-- /.col-4 -->

                            </div>
                            <!-- /.row -->

                            @if ($qrCodeWifi)
                                {!! $qrCodeWifi !!}
                            @endif








                        </div>
                    </div> <!-- col-md-12 -->


                    <div id="search" class="col-md-6"> <!-- search -->
                        <button style="display: none" type="button" onclick="adress_search();">Recherche</button>
                        <div class="wrap_map">
                            <div id="map" style="height: 250px;width: 100%;"></div>
                            <!-- /#map -->
                        </div>
                        <!-- /.wrap_map -->
                        <p>Adresse</p>
                        <input id="address" placeholder="Adresse" type="text" class="form-control"
                            name="address" value="{{ $restaurant->address }}">
                        <div class="wrap_results">
                            <div id="results"></div>
                        </div>

                        <input id="lat" placeholder="lat" type="text" class="form-control "name="lat"
                            value="{{ $restaurant->lat }}">

                        <input id="lon" placeholder="lon" type="text" class="form-control " name="lon"
                            value="{{ $restaurant->lon }}">

                    </div> <!-- search -->

                    <div class="col-md-6">
                        <div class="form-group">
                            <p>Le logo</p>

                            @if ($restaurant->logo)
                                <img style="width: 150px;height: auto;object-fit: contain;    object-position: left;"
                                    src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->logo }}"
                                    alt="Image de la categorie {{ $restaurant->name }}"
                                    style="width: 100%; height: 50vh">
                            @else
                                <img style="width: 100%;height: 150px;object-fit: contain;"
                                    src="{{ $url }}images/default.png" alt="Bannière par default"
                                    style="width: 100%; height: 50vh">
                            @endif


                            <input class="form-control" type="file" name="image" value="">
                            <hr />
                        </div>
                        <div class="form-group mb-3">
                            <p>La bannière</p>

                            @if ($restaurant->banner)
                                <img style="width: 100%;height: 150px;object-fit: contain;    object-position: left;"
                                    src="{{ $url }}images/{{ $restaurant->id }}/{{ $restaurant->banner }}"
                                    alt="Image de la categorie {{ $restaurant->name }}"
                                    style="width: 100%; height: 50vh">
                            @else
                                <img style="width: 100%;height: 150px;object-fit: contain;"
                                    src="{{ $url }}images/default-banner.jpg" alt="Bannière par default"
                                    style="width: 100%; height: 50vh">
                            @endif

                            <input class="form-control" type="file" name="banner" value="">
                            <hr />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>Prochain évènement</p>
                        @if ($restaurant->event_name || $restaurant->event_content)
                            <a class="text-danger" onclick="confirmDeleteEvent({{ $restaurant->id }})"
                                style="display: block;font-size: 12px;">
                                Supprimer l'évènement
                            </a>
                        @endif
                        <label for="event_name">Nom</label>
                        <input type="text" name="event_name" id="event_name" class="form-control"
                            value="{{ $restaurant->event_name }}">
                        <label for="event_name">Description</label>
                        <textarea name="event_content" id="event_content" cols="30" rows="10" class="form-control">{{ $restaurant->event_content }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="col-md-6">
                            <p>Activer le panier</p>
                            <p><small>
                                    <em>
                                        En cochant cette case, vous autorisez la prise de commande sur votre
                                        menu (paiement de la commande non inclu). Le client pourra faire un panier sur
                                        votre
                                        menu et
                                        le valider. Vous recevrez un e-mail avec les coordonnées du client ainsi que sa
                                        commande. Il
                                        ne vous restera plus qu'a demander le paiement a votre client
                                    </em>
                                </small></p>
                            <input type="checkbox" class="demo5" id="active{{ $restaurant->id }}" name="cart"
                                {{ $restaurant->cart ? 'checked=checked' : '' }}>
                            <label for="active{{ $restaurant->id }}"></label>
                        </div>
                        @if ($restaurant->cart)
                            <div class="col-md-6">
                                <label for="cart_instructions">Vos instructions pour la réception ou livraison de la
                                    commande</label>
                                <textarea name="cart_instructions" id="cart_instructions" cols="30" rows="10" maxlength="250"
                                    class="form-control">{{ $restaurant->cart_instructions }}</textarea>

                            </div>
                        @endif
                    </div>
                    <!-- /.col-md-6 -->
                </div><!-- /.row -->
            </div>
            <style>
                input[type="checkbox"].demo5 {
                    display: none;
                }

                input[type="checkbox"].demo5+label {
                    box-sizing: border-box;
                    display: inline-block;
                    width: 3rem;
                    height: 1.5rem;
                    border-radius: 1.5rem;
                    padding: 2px;
                    background-color: #cccccc;
                    transition: all 0.5s;
                }

                input[type="checkbox"].demo5+label::before {
                    box-sizing: border-box;
                    display: block;
                    content: "";
                    height: calc(1.5rem - 4px);
                    width: calc(1.5rem - 4px);
                    border-radius: 50%;
                    background-color: #fff;
                    transition: all 0.5s;
                }

                input[type="checkbox"].demo5:checked+label {
                    background-color: #d3a868;
                }

                input[type="checkbox"].demo5:checked+label::before {
                    margin-left: 1.5rem;
                }
            </style>
            <!-- /.base -->
            <script>
                function confirmDeleteEvent(restaurantId) {
                    if (confirm("Êtes-vous sûr de vouloir supprimer cet évènement ?")) {
                        document.getElementById('event_name').value = null;
                        document.getElementById('event_content').value = null;
                        document.getElementById('prodForm').submit();
                    }
                }
            </script>
            <div class="socials">

                <div class="row">


                    <div class="form-group col-md-6">
                        <p>Lien facebook</p>
                        <input class="form-control" type="text"
                            placeholder="https://www.facebook.com/profile.php?id=100093636714220" name="facebook"
                            value="{{ $restaurant->facebook }}">
                        <hr />
                    </div>

                    <div class="form-group col-md-6">
                        <p>Lien instagram</p>
                        <input class="form-control" type="text"
                            placeholder="https://www.instagram.com/monmenu.io/" name="instagram"
                            value="{{ $restaurant->instagram }}">
                        <hr />
                    </div>

                    <div class="form-group col-md-6">
                        <p>Lien du site</p>
                        <input class="form-control" type="text" placeholder="https://www.monmenu.io/"
                            name="website" value="{{ $restaurant->website }}">
                        <hr />
                    </div>

                    <div class="form-group col-md-6">
                        <p>Lien tripadvisor</p>
                        <input class="form-control" type="text" placeholder="https://www.tripadvisor.fr/monmenu"
                            name="tripadvisor" value="{{ $restaurant->tripadvisor }}">
                        <hr />
                    </div>

                    <div class="form-group col-md-6">
                        <p>Lien tiktok</p>
                        <input class="form-control" type="text" placeholder="https://www.tiktok.com/@monmenu"
                            name="tiktok" value="{{ $restaurant->tiktok }}">
                        <hr />
                    </div>

                    <div class="form-group col-md-6">
                        <p>Lien avis Google <span class="ml-1" data-placement="top" data-toggle="popover"
                                title="Vous souhaitez obtenir votre lien d'avis Google ?"
                                data-content="Rien de plus facile grâce cet outil. Vous pouvez récupérer votre lien d’avis Google en quelques secondes en <a href='https://maplaque-nfc.fr/lien-avis-google/' target='_blank'><b>cliquant ici.</b></a>">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </span></p>



                        <input type="text" id="google_review_link" name="google_review_link" class="form-control"
                            placeholder="https://search.google.com/local/writereview?placeid=..."
                            value="{{ $restaurant->google_review_link }}">

                        <hr />
                    </div>


                </div>
                <!-- /.row -->

            </div>
            <!-- /.socials -->



            <div class="hours">


                <div class="row">




                    <div class="form-group col-md-4">
                        <p>Horaire du lundi</p>
                        <input type="hidden" name="lundi" id="lundi" value="{{ $restaurant->lundi }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input remove-hour" type="checkbox"
                                            @if (!$restaurant->lundi) checked="checked" @endif value=""
                                            data-remove="lundi">
                                        Fermé
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="lundi-matin-ouverture">Ouverture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="lundi-matin-ouverture" name="lundi_matin_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="lundi-matin-fermeture">Fermeture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="lundi-matin-fermeture" name="lundi_matin_fermeture">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="lundi-apresmidi-ouverture">Ouverture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="lundi-apresmidi-ouverture" name="lundi_apresmidi_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="lundi-apresmidi-fermeture">Fermeture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="lundi-apresmidi-fermeture" name="lundi_apresmidi_fermeture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>




                    <div class="form-group col-md-4">
                        <p>Horaire du mardi</p>
                        <input type="hidden" name="mardi" id="mardi" value="{{ $restaurant->mardi }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input remove-hour" type="checkbox"
                                            @if (!$restaurant->mardi) checked="checked" @endif value=""
                                            data-remove="mardi">
                                        Fermé
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="mardi-matin-ouverture">Ouverture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mardi-matin-ouverture" name="mardi_matin_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="mardi-matin-fermeture">Fermeture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mardi-matin-fermeture" name="mardi_matin_fermeture">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="mardi-apresmidi-ouverture">Ouverture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mardi-apresmidi-ouverture" name="mardi_apresmidi_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="mardi-apresmidi-fermeture">Fermeture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mardi-apresmidi-fermeture" name="mardi_apresmidi_fermeture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>





                    <div class="form-group col-md-4">
                        <p>Horaire du mercredi</p>
                        <input type="hidden" name="mercredi" id="mercredi" value="{{ $restaurant->mercredi }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input remove-hour" type="checkbox"
                                            @if (!$restaurant->mercredi) checked="checked" @endif value=""
                                            data-remove="mercredi">
                                        Fermé
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="mercredi-matin-ouverture">Ouverture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mercredi-matin-ouverture" name="mercredi_matin_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="mercredi-matin-fermeture">Fermeture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mercredi-matin-fermeture" name="mercredi_matin_fermeture">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="mercredi-apresmidi-ouverture">Ouverture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mercredi-apresmidi-ouverture" name="mercredi_apresmidi_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="mercredi-apresmidi-fermeture">Fermeture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="mercredi-apresmidi-fermeture" name="mercredi_apresmidi_fermeture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>



                    <div class="form-group col-md-4">
                        <p>Horaire du jeudi</p>
                        <input type="hidden" name="jeudi" id="jeudi" value="{{ $restaurant->jeudi }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input remove-hour" type="checkbox"
                                            @if (!$restaurant->jeudi) checked="checked" @endif value=""
                                            data-remove="jeudi">
                                        Fermé
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="jeudi-matin-ouverture">Ouverture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="jeudi-matin-ouverture" name="jeudi_matin_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="jeudi-matin-fermeture">Fermeture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="jeudi-matin-fermeture" name="jeudi_matin_fermeture">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="jeudi-apresmidi-ouverture">Ouverture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="jeudi-apresmidi-ouverture" name="jeudi_apresmidi_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="jeudi-apresmidi-fermeture">Fermeture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="jeudi-apresmidi-fermeture" name="jeudi_apresmidi_fermeture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>



                    <div class="form-group col-md-4">
                        <p>Horaire du vendredi</p>
                        <input type="hidden" name="vendredi" id="vendredi" value="{{ $restaurant->vendredi }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input remove-hour" type="checkbox"
                                            @if (!$restaurant->vendredi) checked="checked" @endif value=""
                                            data-remove="vendredi">
                                        Fermé
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="vendredi-matin-ouverture">Ouverture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="vendredi-matin-ouverture" name="vendredi_matin_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="vendredi-matin-fermeture">Fermeture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="vendredi-matin-fermeture" name="vendredi_matin_fermeture">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="vendredi-apresmidi-ouverture">Ouverture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="vendredi-apresmidi-ouverture" name="vendredi_apresmidi_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="vendredi-apresmidi-fermeture">Fermeture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="vendredi-apresmidi-fermeture" name="vendredi_apresmidi_fermeture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>



                    <div class="form-group col-md-4">
                        <p>Horaire du samedi</p>
                        <input type="hidden" name="samedi" id="samedi" value="{{ $restaurant->samedi }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input remove-hour" type="checkbox"
                                            @if (!$restaurant->samedi) checked="checked" @endif value=""
                                            data-remove="samedi">
                                        Fermé
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="samedi-matin-ouverture">Ouverture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="samedi-matin-ouverture" name="samedi_matin_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="samedi-matin-fermeture">Fermeture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="samedi-matin-fermeture" name="samedi_matin_fermeture">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="samedi-apresmidi-ouverture">Ouverture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="samedi-apresmidi-ouverture" name="samedi_apresmidi_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="samedi-apresmidi-fermeture">Fermeture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="samedi-apresmidi-fermeture" name="samedi_apresmidi_fermeture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>



                    <div class="form-group col-md-4">
                        <p>Horaire du dimanche</p>
                        <input type="hidden" name="dimanche" id="dimanche" value="{{ $restaurant->dimanche }}">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input remove-hour" type="checkbox"
                                            @if (!$restaurant->dimanche) checked="checked" @endif value=""
                                            data-remove="dimanche">
                                        Fermé
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="dimanche-matin-ouverture">Ouverture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="dimanche-matin-ouverture" name="dimanche_matin_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="dimanche-matin-fermeture">Fermeture (matin)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="dimanche-matin-fermeture" name="dimanche_matin_fermeture">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="dimanche-apresmidi-ouverture">Ouverture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="dimanche-apresmidi-ouverture" name="dimanche_apresmidi_ouverture">
                                    </div>
                                    <div class="col-6">
                                        <label for="dimanche-apresmidi-fermeture">Fermeture (après-midi)</label>
                                        <input class="form-control input-hour timepicker" type="text"
                                            id="dimanche-apresmidi-fermeture" name="dimanche_apresmidi_fermeture">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>




                    {{--
			<div class="form-group col-md-4">
				<p>Horaire du lundi</p>
				<div class="row">


					<div class="col-3">
						<div class="form-check">
							<label class="form-check-label ">
								<input class="form-check-input remove-hour" type="checkbox" @if (!$user->restaurant->lundi) checked="checked" @endif value="" data-remove="lundi">
								Fermé
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<!-- /.col-1 -->
					<div class="col-9">
						<input class="form-control input-hour input-lundi" type="text" placeholder="Mettez vos horaires ici" name="lundi"
						value="{{ $user->restaurant->lundi }}">
					</div>
					<!-- /.col-11 -->

				</div>
				<!-- /.row -->




				<hr />
			</div>


			<div class="form-group col-md-4">
				<p>Horaire du mardi</p>

				<div class="row">
					<div class="col-3">
						<div class="form-check">
							<label class="form-check-label ">
								<input class="form-check-input remove-hour" type="checkbox" value="" data-remove="mardi">
								Fermé
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<!-- /.col-1 -->
					<div class="col-9">
						<input class="form-control input-mardi" type="text" placeholder="Mettez vos horaires ici" name="mardi"
						value="{{ $user->restaurant->mardi }}">
						<hr />
					</div>
				</div>
				<!-- /.row -->
			</div>
			<div class="form-group col-md-4">
				<p>Horaire du mercredi</p>


				<div class="row">
					<div class="col-3">
						<div class="form-check">
							<label class="form-check-label ">
								<input class="form-check-input remove-hour" type="checkbox" value="" data-remove="mercredi">
								Fermé
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<!-- /.col-1 -->
					<div class="col-9">
						<input class="form-control input-mercredi" type="text" placeholder="Mettez vos horaires ici" name="mercredi"
						value="{{ $user->restaurant->mercredi }}">
						<hr />
					</div>
				</div>
				<!-- /.row -->



			</div>



			<div class="form-group col-md-4">
				<p>Horaire du jeudi</p>
				<div class="row">
					<div class="col-3">
						<div class="form-check">
							<label class="form-check-label ">
								<input class="form-check-input remove-hour" type="checkbox" value="" data-remove="jeudi">
								Fermé
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<!-- /.col-1 -->
					<div class="col-9">
						<input class="form-control input-jeudi" type="text" placeholder="Mettez vos horaires ici" name="jeudi"
						value="{{ $user->restaurant->jeudi }}">
						<hr />
					</div>
				</div>
				<!-- /.row -->

			</div>




			<div class="form-group col-md-4">
				<p>Horaire du vendredi</p>

				<div class="row">
					<div class="col-3">
						<div class="form-check">
							<label class="form-check-label ">
								<input class="form-check-input remove-hour" type="checkbox" value="" data-remove="vendredi">
								Fermé
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<!-- /.col-1 -->
					<div class="col-9">
						<input class="form-control input-vendredi" type="text" placeholder="Mettez vos horaires ici" name="vendredi"
						value="{{ $user->restaurant->vendredi }}">
						<hr />
					</div>
				</div>
				<!-- /.row -->


			</div>





			<div class="form-group col-md-4">
				<p>Horaire du samedi</p>



				<div class="row">
					<div class="col-3">
						<div class="form-check">
							<label class="form-check-label ">
								<input class="form-check-input remove-hour" type="checkbox" value="" data-remove="samedi">
								Fermé
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<!-- /.col-1 -->
					<div class="col-9">
						<input class="form-control input-samedi" type="text" placeholder="Mettez vos horaires ici" name="samedi"
						value="{{ $user->restaurant->samedi }}">
						<hr />
					</div>
				</div>
				<!-- /.row -->



			</div>

			<div class="form-group col-md-4">
				<p>Horaire du dimanche</p>


				<div class="row">
					<div class="col-3">
						<div class="form-check">
							<label class="form-check-label ">
								<input class="form-check-input remove-hour" type="checkbox" value="" data-remove="dimanche">
								Fermé
								<span class="form-check-sign">
									<span class="check"></span>
								</span>
							</label>
						</div>
					</div>
					<!-- /.col-1 -->
					<div class="col-9">
						<input class="form-control input-dimanche" type="text" placeholder="Mettez vos horaires ici" name="dimanche"
						value="{{ $user->restaurant->dimanche }}">
						<hr />
					</div>
				</div>
				<!-- /.row -->



			</div>

			--}}


                </div>
                <!-- /.row -->


            </div>
            <!-- /.hours -->







    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-fill btn-primary">Mettre a jour</button>
    </div>
    </form>
</div>
