@if (auth()->check())
    @if ($user->id== $restaurant->admin_id)
        <a href="#" class="mt-4 btn_product_add" title="" data-bs-toggle="modal"
            data-bs-target="#modal_product_add">
    
            Ajouter un produit</strong>
        </a>
        <!-- Modal -->
        <div class="modal fade" id="modal_product_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un produit </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="prodForm" action="{{ route('createprod') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="category_id" value="{{ $currentCategory->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Nom du produit" name="name">
                                <hr />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" placeholder="Prix" name="price">
                                <hr />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content" row="3" placeholder="Description"></textarea>
                                <hr />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control"  name="allergenes" row="3" placeholder="Allergènes"></textarea>
                                <hr/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="file" name="image" value="">
                                <hr />
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="active" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault" checked="checked">
                                    Actif
                                </label>
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
