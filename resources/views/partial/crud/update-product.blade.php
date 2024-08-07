@if (auth()->check())
    @if ($user->id == $restaurant->admin_id || $user->role === 'ROLE_ADMIN' || $user->role === 'ROLE_SUBAD')
        <!-- Modal -->
        <div class="modal fade" id="modal-update_product-{{ $product->id }}" tabindex="-1" aria-labelledby=""
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier un produit </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="prodForm" action="{{ route('updateprod', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Nom du produit" name="name"
                                    value="{{ $product->name }}">
                                <hr />
                            </div>
                            <div class="form-group">
                                <select name="categorie" id="categorie" class="form-control" required>
                                    @foreach ($mainCategories as $item)
                                        @if (isset($product->categories) && !empty($product->categories[0]))
                                            <option @if ($product->categories[0]->id === $item->id) selected="selected" @endif
                                                @endif
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            @if (isset($product->categories) && !empty($product->categories[0]))
                                <input type="text" value="{{ $product->categories[0]->id }}" name="old_cat" hidden>
                            @endif
                            <div class="form-group">
                                <input class="form-control" type="number" placeholder="Prix" name="price"
                                    value="{{ $product->price }}" step="any">
                                <hr />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content" row="3" placeholder="Description">{{ $product->content }}</textarea>
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="appellations">Appellations</label>
                                <div>
                                    <label><input type="checkbox" name="appellations[]" value="bio"
                                            @if ($product->appellations && $product->appellations !== 'null' && in_array('bio', json_decode($product->appellations))) checked="checked" @endif> BIO</label><br>
                                    <label><input type="checkbox" name="appellations[]" value="halal"
                                            @if (
                                                $product->appellations &&
                                                    $product->appellations !== 'null' &&
                                                    in_array('halal', json_decode($product->appellations))) checked="checked" @endif>
                                        HALAL</label><br>
                                    <label><input type="checkbox" name="appellations[]" value="casher"
                                            @if (
                                                $product->appellations &&
                                                    $product->appellations !== 'null' &&
                                                    in_array('casher', json_decode($product->appellations))) checked="checked" @endif>
                                        CASHER</label><br>
                                    <label><input type="checkbox" name="appellations[]" value="aop"
                                            @if ($product->appellations && $product->appellations !== 'null' && in_array('aop', json_decode($product->appellations))) checked="checked" @endif> AOP</label><br>
                                    <label><input type="checkbox" name="appellations[]" value="label-rouge"
                                            @if (
                                                $product->appellations &&
                                                    $product->appellations !== 'null' &&
                                                    in_array('label-rouge', json_decode($product->appellations))) checked="checked" @endif> Label
                                        rouge</label><br>
                                    <label><input type="checkbox" name="appellations[]" value="vegan"
                                            @if (
                                                $product->appellations &&
                                                    $product->appellations !== 'null' &&
                                                    in_array('vegan', json_decode($product->appellations))) checked="checked" @endif>
                                        végan</label><br>
                                    <label><input type="checkbox" name="appellations[]" value="sans-gluten"
                                            @if (
                                                $product->appellations &&
                                                    $product->appellations !== 'null' &&
                                                    in_array('sans-gluten', json_decode($product->appellations))) checked="checked" @endif> sans
                                        gluten</label><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="allergenes">Allergènes</label>
                                <div>
                                    <label><input type="checkbox" name="allergenes[]" value="Gluten (blé, seigle, orge)"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Gluten (blé, seigle, orge)', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Gluten (blé, seigle, orge)</label><br>
                                    <label><input type="checkbox" name="allergenes[]" value="Œufs"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Œufs', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Œufs</label><br>
                                    <label><input type="checkbox" name="allergenes[]" value="Lait et produits laitiers"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Lait et produits laitiers', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Lait et produits laitiers</label><br>
                                    <label><input type="checkbox" name="allergenes[]"
                                            value="Noix (amandes, noisettes, noix de cajou, etc.)"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Noix (amandes, noisettes, noix de cajou, etc.)', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Noix (amandes, noisettes, noix de cajou, etc.)</label><br>
                                    <label><input type="checkbox" name="allergenes[]" value="Poissons"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Poissons', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Poissons</label><br>
                                    <label><input type="checkbox" name="allergenes[]"
                                            value="Crustacés (crevettes, crabes, homards, etc.)"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Crustacés (crevettes, crabes, homards, etc.)', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Crustacés (crevettes, crabes, homards, etc.)
                                    </label><br>
                                    <label><input type="checkbox" name="allergenes[]" value="Soja"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Soja', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Soja</label><br>
                                    <label><input type="checkbox" name="allergenes[]" value="Graines de sésame"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Graines de sésame', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Graines de sésame</label><br>
                                    <label><input type="checkbox" name="allergenes[]"
                                            value="Sulfites (utilisés comme conservateurs)"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Sulfites (utilisés comme conservateurs)', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Sulfites (utilisés comme conservateurs)</label><br>
                                    <label><input type="checkbox" name="allergenes[]" value="Moutarde"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Moutarde', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Moutarde</label><br>
                                    <label><input type="checkbox" name="allergenes[]"
                                            value="Lupin (une plante de la famille des légumineuses)"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Lupin (une plante de la famille des légumineuses)', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Lupin (une plante de la famille des légumineuses)</label><br>
                                    <label><input type="checkbox" name="allergenes[]" value="Céleri"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Céleri', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Céleri</label><br>
                                    <label><input type="checkbox" name="allergenes[]"
                                            value="Mollusques (moules, huîtres, escargots, etc.)"
                                            @if (
                                                $product->allergenes_list &&
                                                    $product->allergenes_list !== 'null' &&
                                                    in_array('Mollusques (moules, huîtres, escargots, etc.)', json_decode($product->allergenes_list))) checked="checked" @endif>
                                        Mollusques (moules, huîtres, escargots, etc.)</label><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    @if ($product->image)
                                        <img style="width:150px"
                                            src="{{ $url }}images/{{ $restaurant->id }}/{{ $product->image }}">
                                    @else
                                        <img style="width:150px" src="{{ $url }}images/default.png">
                                    @endif
                                </div>
                                <label for="imageProd">Changer d'image</label>
                                <input class="form-control" type="file" name="image" value=""
                                    id="imageProd">
                                <hr />
                            </div>
                            <div class="form-group">
                                <p>Visible ou caché</p>
                                <input type="checkbox" class="demo5" id="active{{ $product->id }}" name="active"
                                    {{ $product->active ? 'checked=checked' : '' }}>
                                <label for="active{{ $product->id }}"></label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Mettre a jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
    @endif
@endif
