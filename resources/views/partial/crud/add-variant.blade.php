@if (auth()->check())
    @if ($user->id == $restaurant->admin_id || $user->role === 'ROLE_ADMIN' || $user->role === 'ROLE_SUBAD')
        <!-- Modal -->
        <div class="modal fade" id="modal-add-variante-{{ $product->id }}" tabindex="-1" aria-labelledby=""
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une variante au produit - <strong>{{ $product->name }}</strong>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="prodForm" action="{{ route('addVariant') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input class="form-control" type="text" placeholder="Nom de la variante"
                                    name="name" required>
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="price">Prix (non obligatoire si identique au prix du produit)</label>
                                <input class="form-control" type="number" placeholder="Prix de la variante"
                                    name="price" step="any">
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="price">Description</label>
                                <textarea class="form-control" name="content" id="" cols="30" rows="10"
                                    placeholder="Description de la variante" style="resize: none"></textarea>
                                <hr />
                            </div>
                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ajouter la variante</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    @endif
@endif
