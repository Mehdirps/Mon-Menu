@if (auth()->check())
    @if ($user->id == $restaurant->admin_id)
        <!-- Modal -->
        <div class="modal fade" id="modal-update_variante-{{ $item->id }}" tabindex="-1" aria-labelledby=""
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modification de la variante - <strong>{{ $item->name }}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="prodForm" action="{{ route('updateVariant', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input class="form-control" type="text" placeholder="Nom de la variante"
                                    name="name" required value="{{ $item->name }}">
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input class="form-control" type="number" placeholder="Prix de la variante"
                                    name="price" step="any" value="{{ $item->price }}">
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="price">Description</label>
                                <textarea class="form-control" name="content" id="" cols="30" rows="10"
                                    placeholder="Description de la variante" style="resize: none">{{ $item->concent }}</textarea>
                                <hr />
                            </div>
                            <input type="text" name="product_id" hidden value="{{ $product->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Modifier la variante</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    @endif
@endif
