@if (auth()->check())
    @if (Auth::User()->isAdmin())
        @if ($user->id== $restaurant->admin_id)
            @if ($currentCategory->is_main)
                <a href="#" title="" data-bs-toggle="modal"
                    data-bs-target="#modal_category_add_{{ $main }}" id="idaddcat" class="add_sous_cat">
                    @if ($main)
                        Ajouter une catégorie principale</strong>
                    @else
                        <span>
                            <svg fill="none" height="512" viewBox="0 0 24 24" width="512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-rule="evenodd" fill="rgb(0,0,0)" fill-rule="evenodd">
                                    <path
                                        d="m1.25 12c0-5.93706 4.81294-10.75 10.75-10.75 5.9371 0 10.75 4.81294 10.75 10.75 0 5.9371-4.8129 10.75-10.75 10.75-5.93706 0-10.75-4.8129-10.75-10.75zm10.75-9.25c-5.10864 0-9.25 4.14136-9.25 9.25 0 5.1086 4.14136 9.25 9.25 9.25 5.1086 0 9.25-4.1414 9.25-9.25 0-5.10864-4.1414-9.25-9.25-9.25z" />
                                    <path
                                        d="m12 7.25c.4142 0 .75.33579.75.75v8c0 .4142-.3358.75-.75.75s-.75-.3358-.75-.75v-8c0-.41421.3358-.75.75-.75z" />
                                    <path
                                        d="m7.25 12c0-.4142.33579-.75.75-.75h8c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-8c-.41421 0-.75-.3358-.75-.75z" />
                                </g>
                            </svg>
                        </span>
                        Ajouter une sous catégorie dans <strong> {{ $currentCategory->name }} </strong>
                    @endif
                </a>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="modal_category_add_{{ $main }}" tabindex="-1" aria-labelledby=""
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- header -->
                            <h5 class="modal-title">Ajouter une catégorie </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div> <!-- header -->

                        <form id="catForm" action="{{ route('createcat') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Nom de la catégorie</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Nom de la catégorie" name="name">
                                </div>
                                <div class="form-group mt-4">
                                    <img id="imagePreview" src="#" alt="Aperçu de l'image" class="mb-4"
                                        style="display: none;width: 100%;">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image"
                                        required>

                                </div>

                                @if ($main)
                                    <input type="hidden" name="is_main" value="1">
                                @else
                                    <input type="hidden" name="is_main" value="0">
                                    <input type="hidden" name="parent_id" value="{{ $currentCategory->id }}">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>
                                    Ajouter</button>
                                <br>
                                @error('image')
                                    <div id="errorMessages" class="text-danger"
                                        data-modal-id="modal_category_add_{{ $main }}">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
        @endif
    @endif
@endif
