<?php $url = config('app.url'); ?>
<div class="card ">
    <div class="card-header">
        <h4 class="card-title"> Mes catégories</h4>
    </div>
    @if (auth()->check())
        @if ($user->id == $restaurant->admin_id || $user->role === "ROLE_ADMIN" || $user->role === "ROLE_SUBAD")
            <a href="#" class="btn btn-fill btn-primary" title="" data-toggle="modal"
                data-target="#modal_category_add" style="width: max-content; margin:auto;">
                Ajouter une catégorie</strong>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="modal_category_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter une catégorie </h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="prodForm" action="{{ route('createcat') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Nom de la categorie"
                                        name="name">
                                    <hr />
                                </div>
                                <div class="form-group">
                                    <label for="parent_id" style="color: black">Si vous souhaitez créer une sous
                                        catégorie, séléctionné une catégorie parente</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="" selected="selected">-- Sous catégorie de --
                                        </option>
                                        @foreach ($mainCategories as $item)
                                            @if ($item->is_main === 1)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control block-content" name="content" row="3" placeholder="Description"></textarea>
                                    <hr />
                                </div>
                                <div class="form-group select-2-none">
                                    <label for="image" class="d-block">Icone de la catégorie</label>
                                    {{-- <input type="text" name="search-fake" id="search-fake"> --}}
                                    <select name="image" id="image-add" required class="form-control select-img">
                                        @foreach ($categoriesIcons as $item)
                                            <option value="{{ $item }}"
                                                style="background:url('{{ $url }}categories-icons/{{ $item }}') no-repeat; width:100px; height:100px;">
                                                {{ substr($item, 0, -4) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
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
    <div class="card-body" style="font-size: 11px;">
        <div id="response"></div>
        <ul id="items" class="items">
            <li class="prems">
                <div class="item_prod item_drag">#</div>

                <div class="item_prod item_order">Ord.</div>

                <div class="item_prod item_i,g">Image</div>

                <div class="item_prod item_name">Nom</div>

                <div class="item_prod item_name">Description</div>

                <div class="item_prod item_del"></div>

            </li>
            <style>
            </style>
            @foreach ($mainCategories->sortBy('display_order') as $category)
                <li style="display:grid; justify-items: center;grid-template-columns: repeat(6,1fr); justify-items:start;"
                    id="prod-{{ $category->id }}" data-id="{{ $category->id }}">
                    <div class="item_prod item_drag"><i class="fas fa-arrows-alt handle"></i></div>
                    <div class="item_prod item_order">{{ $category->display_order }}</div>
                    <div class="item_img item_prod">
                        @if ($category->is_main)
                            @if ($category->image)
                                <img src="{{ $url }}categories-icons/{{ $category->image }}"
                                    alt=" Image de {{ $category->name }}"
                                    style="width: 50px; height:50px; object-fit:contain;">
                            @else
                                <img src="{{ $url }}images/default.png" alt="Image par default"
                                    style="width: 50px; height:50px; object-fit:contain;">
                            @endif
                        @endif
                    </div>
                    <div>
                        @if ($category->parent_id)
                            <?php
                            $parent_cat = \App\Models\Category::find($category->parent_id);
                            ?><em>{{ $parent_cat->name }}</em> --
                        @endif <b>
                            <a href="#" title="" data-toggle="modal"
                                data-target="#modal-update_category_{{ $category->id }}">
                                {{ $category->name }}
                            </a>
                        </b>
                    </div>

                    <div>
                        <small>
                            {{ Illuminate\Support\Str::limit($category->content, 15) }}
                        </small>
                    </div>
                    <div style="min-width: 70px;">
                        @if (auth()->check())
                            @if ($user->id === $restaurant->admin_id || $user->role === "ROLE_ADMIN" || $user->role === "ROLE_SUBAD")
                                <a href="#" title="" data-toggle="modal"
                                    data-target="#modal-update_category_{{ $category->id }}"
                                    class="updatecategory text-center">
                                    <i class="tim-icons icon-pencil"></i>
                                </a>
                                @include('../partial.crud.update-category')
                                <form id="delete-form-{{ $category->id }}"
                                    action="{{ route('deletecat', $category->id) }}" method="POST"
                                    enctype="multipart/form-data" class="delete-form ml-4"
                                    style="display:inline-flex; gap:5px;">
                                    @csrf
                                    @method('delete')
                                    <small>
                                        <a class="text-danger"
                                            onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}' )">
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
                            @endif
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="psrail-x" style="left: 0px; bottom: 0px; width: 315px;">
        <div class="psthumb-x" tabindex="0" style="left: 0px; width: 288px;"></div>
    </div>
    <div class="psrail-y" style="top: 0px; right: 0px;">
        <div class="psthumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</div>
