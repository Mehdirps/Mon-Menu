<div class="modal fade" id="modal-update_category_{{ $category->id }}" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <!-- dialog -->
        <div class="modal-content">
            <!-- content -->
            <div class="modal-header">
                <!-- header -->
                @if ($category->name == 'Ma première catégorie')
                    <h5 class="modal-title">Création d'une categorie </h5>
                @else
                    <h5 class="modal-title">Mettre à jour une categorie </h5>
                @endif
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div> <!-- header -->
            <form id="" action="{{ route('updatecat', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- modal-body -->
                <div class="modal-body">
                    <!-- form-group -->
                    <div class="form-group">
                        <label for="name">Nom de la catégorie</label>
                        <input type="text" class="form-control" id="name" name="name" required="required"
                            @if ($category->name == 'Ma première catégorie') value=""
                        placeholder="Ma première catégorie"

                        @else
                        placeholder="Nom de la catégorie"
                        value="{{ $category->name }}" @endif>
                    </div>
                    @if (!$category->childs)
                        <div class="form-group">
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="" selected="selected">-- Changer de catégorie parente --</option>
                                @foreach ($mainCategories as $item)
                                    @if ($item->is_main == 1 && $item !== $category)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="parent_id" value="{{ $currentCategory->id }}">
                    @endif
                    @if ($category->is_main)
                        <div class="form-group">
                            <label for="content">Description de la catégorie</label>
                            <textarea name="content" class="form-control" id="" cols="30" rows="10" style="resize: none;"> {{ $category->content }}</textarea>
                        </div>
                    @endif
                    <!-- form-group -->

                    <!-- form-group -->
                    @if ($category->is_main)
                        <div class="form-group mt-4">
                            <label for="image">Icon de la catégorie</label>
                            <select name="image" id="image" required class="form-control">
                                @if ($category->image)
                                    <option value="{{ $category->image }}"
                                        style="background:url('{{ $url }}categories-icons/{{ $category->image }}') no-repeat; width:100px; height:100px;">
                                        {{ substr($category->image, 0, -4) }}
                                    </option>
                                @else
                                    <option value="" selected>-- Choisissez un icon --</option>
                                @endif
                                @foreach ($categoriesIcons as $item)
                                    <option value="{{ $item }}"
                                        style="background:url('{{ $url }}categories-icons/{{ $item }}') no-repeat; width:100px; height:100px;">
                                        {{ substr($item, 0, -4) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <!-- form-group -->
                </div>
                <!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        @if ($category->name == 'Ma première catégorie')
                            Créer ma première catégorie
                        @else
                            <i class="fas fa-edit"></i>
                            Modifier la catégorie
                        @endif
                    </button>
                    <br>
                    <div id="errorMessages" class="text-danger" style="display: none;"></div>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>

        </div> <!-- content -->
    </div> <!-- dialog -->
</div> <!-- Modal -->
