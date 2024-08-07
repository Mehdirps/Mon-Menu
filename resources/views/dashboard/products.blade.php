<style>
    .variants-wrap.variants-69.variants-active {
        /*position: absolute;*/
        z-index: 10;
        background: white;
        padding: 10px;
        /*border-radius: 3px;*/
        /*box-shadow: 5px 6px 12px #00000054;*/
    }

    ul#items-variantes {
        position: relative;
    }

    .variants-wrap {
        display: none;
    }
</style>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"> Mes produits</h4>
    </div>
    @if (auth()->check())
        @if ($user->id == $restaurant->admin_id || $user->role === 'ROLE_ADMIN' || $user->role === 'ROLE_SUBAD')
            <a href="#" class="btn btn-fill btn-primary" title="" data-toggle="modal"
                data-target="#modal_product_add" style="width: max-content; margin:auto;">
                Ajouter un produit</strong>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="modal_product_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter un produit </h5>
                            <button type="button" class=" close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form id="prodForm" action="{{ route('createprod') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Nom du produit"
                                        name="name">
                                    <hr />
                                </div>
                                <div class="form-group">
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" disabled selected="selected">-- Choisissez la catégorie
                                            --</option>
                                        @foreach ($mainCategories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="number" placeholder="Prix" name="price"
                                        step="any">
                                    <hr />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="content" row="3" placeholder="Description"></textarea>
                                    <hr />
                                </div>
                                {{-- <div class="form-group">
                                    <textarea class="form-control" name="allergenes" row="3" placeholder="Allergènes"></textarea>
                                    <hr />
                                </div> --}}
                                <div class="form-group">
                                    <label for="appellations">Appellations</label>
                                    <div>
                                        <label><input type="checkbox" name="appellations[]" value="bio">
                                            BIO</label><br>
                                        <label><input type="checkbox" name="appellations[]" value="halal">
                                            HALAL</label><br>
                                        <label><input type="checkbox" name="appellations[]" value="casher">
                                            CASHER</label><br>
                                        <label><input type="checkbox" name="appellations[]" value="aop">
                                            AOP</label><br>
                                        <label><input type="checkbox" name="appellations[]" value="label-rouge"> Label
                                            rouge</label><br>
                                        <label><input type="checkbox" name="appellations[]" value="vegan">
                                            végan</label><br>
                                        <label><input type="checkbox" name="appellations[]" value="sans-gluten"> sans
                                            gluten</label><br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="allergenes">Allergènes</label>
                                    <div>
                                        <label><input type="checkbox" name="allergenes[]"
                                                value="Gluten (blé, seigle, orge)">
                                            Gluten (blé, seigle, orge)</label><br>
                                        <label><input type="checkbox" name="allergenes[]" value="Œufs">
                                            Œufs</label><br>
                                        <label><input type="checkbox" name="allergenes[]"
                                                value="Lait et produits laitiers">
                                            Lait et produits laitiers</label><br>
                                        <label><input type="checkbox" name="allergenes[]"
                                                value="Noix (amandes, noisettes, noix de cajou, etc.)">
                                            Noix (amandes, noisettes, noix de cajou, etc.)</label><br>
                                        <label><input type="checkbox" name="allergenes[]" value="Poissons">
                                            Poissons</label><br>
                                        <label><input type="checkbox" name="allergenes[]"
                                                value="Crustacés (crevettes, crabes, homards, etc.)">
                                            Crustacés (crevettes, crabes, homards, etc.)</label><br>
                                        <label><input type="checkbox" name="allergenes[]" value="Soja">
                                            Soja</label><br>
                                        <label><input type="checkbox" name="allergenes[]" value="Graines de sésame">
                                            Graines de sésame</label><br>
                                        <label><input type="checkbox" name="allergenes[]"
                                                value="Sulfites (utilisés comme conservateurs)">
                                            Sulfites (utilisés comme conservateurs)</label><br>
                                        <label><input type="checkbox" name="allergenes[]" value="Moutarde">
                                            Moutarde</label><br>
                                        <label><input type="checkbox" name="allergenes[]"
                                                value="Lupin (une plante de la famille des légumineuses)">
                                            Lupin (une plante de la famille des légumineuses)</label><br>
                                        <label><input type="checkbox" name="allergenes[]" value="Céleri">
                                            Céleri</label><br>
                                        <label><input type="checkbox" name="allergenes[]"
                                                value="Mollusques (moules, huîtres, escargots, etc.)">
                                            Mollusques (moules, huîtres, escargots, etc.)</label><br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="file" name="image" value="">
                                    <hr />
                                </div>
                                <div class="form-group">
                                    <p>Visible ou caché</p>
                                    <input type="checkbox" class="demo5" id="active" name="active">
                                    <label for="active"></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
        @endif
    @endif
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
    <div class="card-body" style="font-size: 11px;">


        <div class="dropdown filters_btn">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                data-toggle="dropdown" aria-expanded="false">
                Catégories
            </button>
            <ul class="dropdown-menu filter_btn" aria-labelledby="dropdownMenuButton2">
                <li data-show="all">
                    <a class="dropdown-item" href="#">
                        Voir tout
                    </a>
                </li>

                </li>
                @foreach ($mainCategories as $categorie)
                    <li data-show="cat-{{ $categorie->slug }}">
                        <a class="dropdown-item" href="#">{{ $categorie->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un produit">


        <div id="response"></div>
        <!-- /#response -->

        <ul id="items" class="items">

            <li class="prems">
                <div class="item_prod item_drag">#</div>

                <div class="item_prod item_order">Ord.</div>

                <div class="item_prod item_img"></div>

                <div class="item_prod item_name">Nom</div>

                <div class="item_prod item_price">€</div>

                <div class="item_prod item_cat"></div>

                <div class="item_prod item_fav">Fav.</div>

                <div class="item_prod item_pencil"></div>

                <div class="item_prod item_pencil"></div>

                <div class="item_prod item_del"></div>

            </li>

            @foreach ($products->sortBy('display_order') as $product)
                @if (count($product->categories) > 0)
                    <li id="prod-{{ $product->id }}" data-id="{{ $product->id }}"
                        @if (isset($product->categories) && !empty($product->categories[0])) class="tr_cat cat-{{ $product->categories[0]->slug }}"
                    @else
                         class="tr_cat" @endif>
                        <div class="item_prod item_drag"><i class="fas fa-arrows-alt handle"></i></div>

                        <div class="item_prod item_order">{{ $product->display_order }}</div>

                        <div class="item_img item_prod"
                            style="display: flex;flex-direction: column;
                };gap:5px;align-items:center;">
                            @if ($product->image)
                                <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}">
                                <div class="item_prod item_del">
                                    <form id="delete-img-{{ $product->id }}"
                                        action="{{ route('deleteprodimage', $product->id) }}" method="POST"
                                        enctype="multipart/form-data" class="delete-form"
                                        style="display:inline-flex; gap:5px;">
                                        @csrf
                                        @method('delete')
                                        <small>
                                            <a class="text-danger"
                                                onclick="confirmDeleteImage({{ $product->id }}, '{{ $product->name }}' )">
                                                <i class="tim-icons icon-trash-simple"></i>
                                            </a>
                                        </small>
                                    </form>
                                </div>
                            @else
                                <img src="{{ $url }}images/default.png">
                            @endif
                        </div>
                        <div class="item_name item_prod">
                            <a href="#" title="" data-toggle="modal"
                                data-target="#modal-update_product-{{ $product->id }}" class=""><span
                                    style="max-width: 100px;display: block;">{{ $product->name }}</span></a>
                            @if (!$product->active)
                                <em><small>Hors ligne</small></em>
                            @endif
                        </div>
                        <div class="item_price item_prod">
                            {{ $product->price }}
                        </div>
                        <div class="item_prod item_cat">
                            @if (isset($product->categories) && !empty($product->categories[0]))
                                {{ $product->categories[0]->name }}
                            @endif>
                        </div>

                        <div class="item_fav item_prod">
                            @if ($product->featured)
                                <i class="tim-icons icon-shape-star"></i>
                            @endif
                        </div>
                        <div class="item_prod">
                            <a href="#" title="" data-toggle="modal"
                                data-target="#modal-add-variante-{{ $product->id }}"
                                class="updateproduct text-center">
                                + variante
                            </a>
                        </div>
                        <div class="item_prod item_pencil">
                            <a href="#" title="" data-toggle="modal"
                                data-target="#modal-update_product-{{ $product->id }}"
                                class="updateproduct text-center">
                                <i class="tim-icons icon-pencil"></i>
                            </a>
                        </div>
                        <div class="item_prod item_del">
                            <form id="delete-form-{{ $product->id }}"
                                action="{{ route('deleteprod', $product->id) }}" method="POST"
                                enctype="multipart/form-data" class="delete-form"
                                style="display:inline-flex; gap:5px;">
                                @csrf
                                @method('delete')
                                <small>
                                    <a class="text-danger"
                                        onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}' )">
                                        <i class="tim-icons icon-trash-simple"></i>
                                    </a>
                                </small>
                            </form>
                        </div>

                    </li>
                    @if (count($product->variants) > 0)
                        <ul id="items-variantes" class="items cat-{{ $product->categories[0]->slug }} tr_cat">
                            <p class="show-variants" onclick="openVariants({{ $product->id }})"><strong>Voir les
                                    variante de {{ $product->name }}</strong><svg class="svg"
                                    xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                    viewBox="0 0 15 15">
                                    <path fill="none" stroke="currentColor" stroke-linecap="square"
                                        d="m14 5l-6.5 7L1 5" />
                                </svg></p>
                            <div class="variants-wrap variants-{{ $product->id }}"
                                style="display: none;min-width: 250px">
                                <li class="items">
                                    <div class="item-prod" style="width: 20%;">Nom</div>
                                    <div class="item-prod" style="width: 20%;">Prix</div>
                                    <div class="item-prod" style="width: 20%;">Description</div>
                                    <div class="item-prod" style="width: 20%;"></div>
                                    <div class="item-prod" style="width: 20%;"></div>
                                </li>
                                @foreach ($product->variants as $item)
                                    <li class="items">
                                        <div class="item_name" style="width: 20%;">{{ $item->name }}</div>
                                        <div class="item-prod" style="width: 20%;">{{ $item->price }}</div>
                                        <div class="item-prod" style="margin-left: 5px;width: 20%;">
                                            {{ $item->content }}
                                        </div>
                                        <div class="item-prod" style="margin-left: 5px;width: 20%;">
                                            <a href="#" title="" data-toggle="modal"
                                                data-target="#modal-update_variante-{{ $item->id }}"
                                                class="">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                        </div>
                                        <div class="item-prod" style="margin-left: 5px;width: 20%;">
                                            <form id="delete-variant-{{ $item->id }}"
                                                action="{{ route('deleteVariant', $item->id) }}" method="POST"
                                                enctype="multipart/form-data" class="delete-form"
                                                style="display:inline-flex; gap:5px;">
                                                @csrf
                                                @method('delete')
                                                <small>
                                                    <a class="text-danger"
                                                        onclick="confirmDeleteVariante({{ $item->id }}, '{{ $item->name }}' )">
                                                        <i class="tim-icons icon-trash-simple"></i>
                                                    </a>
                                                </small>
                                            </form>
                                        </div>
                                    </li>
                                    @include('../partial.crud.update-variant')
                                @endforeach
                            </div>
                        </ul>
                    @endif
                    @include('../partial.crud.update-product')

                    @include('../partial.crud.add-variant')
                @endif
            @endforeach
            <style>
                .variants {
                    display: none;
                }

                .variants-active {
                    display: initial !important;
                }

                .show-variants {
                    cursor: pointer
                }

                .show-variants svg {
                    margin-left: 5px;

                }
            </style>
            <script>
                function openVariants(id) {
                    const variants = document.querySelector('.variants-' + id);
                    variants.classList.toggle('variants-active');
                }
            </script>

        </ul>


        <script>
            function confirmDelete(categoryId, categoryName) {
                if (confirm("Êtes-vous sûr de vouloir supprimer ce produit ( " + categoryName + "    " + categoryId +
                        "  ) ?")) {
                    document.getElementById('delete-form-' + categoryId).submit();
                }
            }

            function confirmDeleteImage(categoryId, categoryName) {
                if (confirm("Êtes-vous sûr de vouloir supprimer l'image de ce produit ( " + categoryName +
                        "  ) ?")) {
                    document.getElementById('delete-img-' + categoryId).submit();
                }
            }

            function confirmDeleteVariante(categoryId, categoryName) {
                if (confirm("Êtes-vous sûr de vouloir supprimer la variante ( " + categoryName +
                        "  ) ?")) {
                    document.getElementById('delete-variant-' + categoryId).submit();
                }
            }
        </script>

        <!-- / -->

        {{--

<div class="table-responsive ps ps--active-x">
    <table class="table tablesorter " id="">
        <thead class=" text-primary">
            <tr>
                <th>
                    <span style="font-size: 11px;"></span>
                </th>
                <th>
                 <span style="font-size: 11px;">Nom</span>
             </th>
             <th>
                 <span style="font-size: 11px;">Prix</span>
             </th>
             <th>
              <span style="font-size: 11px;">Cat.</span>
          </th>
          <th class="text-center">
             <span style="font-size: 11px;">Fav.</span>
         </th>
         <th class="text-center">
         </th>
     </tr>
 </thead>
 <tbody>
    @foreach ($products as $product)
    <tr class="tr_cat cat-{{ $product->categories[0]->slug }}">
        <td>
            @if ($product->image)
            <img src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}"
            alt=" Image de {{ $product->name }}"
            style="width: 50px; height:50px; object-fit:contain;">
            @else
            <img src="{{ $url }}images/default.png" alt="Image par default" style="width: 50px; height:50px; object-fit:contain;">
            @endif
        </td>
        <td>
           <a href="#" title="" data-toggle="modal"
           data-target="#modal-update_product-{{ $product->id }}"
           class="">{{ $product->name }}</a>
           @if (!$product->active)
           <em><small>Hors ligne</small></em>
           @endif
       </td>
       <td>
        {{ $product->price }}
    </td>
    <td>
     <small style="">
         {{ $product->categories[0]->name }}
     </small>
 </td>
 <td class="text-center">
    @if ($product->featured)
    <i class="tim-icons icon-shape-star"></i>
    @endif

</td>

<td style="min-width: 70px;">
    @if (auth()->check())
    @if ($user->restaurant_id === $restaurant->id)
    <a href="#" title="" data-toggle="modal"
    data-target="#modal-update_product-{{ $product->id }}"
    class="updateproduct text-center">
    <i class="tim-icons icon-pencil"></i>
</a>

<form id="delete-form-{{ $product->id }}"
    action="{{ route('deleteprod', $product->id) }}" method="POST"
    enctype="multipart/form-data" class="delete-form ml-4"
    style="display:inline-flex; gap:5px;">
    @csrf
    @method('delete')
    <small>
        <a class="text-danger"
        onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}' )">
        <i class="tim-icons icon-trash-simple"></i>
    </a>
</small>
</form>

<script>
    function confirmDelete(categoryId, categoryName) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ( " + categoryName + "    " + categoryId +
            "  ) ?")) {
            document.getElementById('delete-form-' + categoryId).submit();
    }
}
</script>

@include('../partial.crud.update-product')
@endif
@endif
</td>
</tr>

@endforeach
</tbody>
</table>

--}}

    </div>
</div>
