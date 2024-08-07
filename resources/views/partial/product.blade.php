<div class="product col-12 col-sm-6 col-md-4 py-4 @if($loop->even)  @endif"> <!-- product -->
    <div class="row"> <!-- row -->
      <div class="col-12"> <!-- col -->
       <div class="wrap_img"> <!-- wrap_img -->
         <div class="card_price"> <!-- card_price -->
          {{ $product->price }} €
        </div> <!-- card_price -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal_produit_{{$product->id}}">
          @if($product->image)
        <img class="card-img-top" src="{{ asset('images/products/'.$product->image )}}">
        @else
        <img class="card-img-top" src="{{ asset('images/products/default.png' )}}">
        @endif
        </a>
      </div> <!-- wrap_img -->
    </div> <!-- col -->
    <div class="col-12 text-center"> <!-- col -->
      <h1>{{ $product->name }}</h1>
     <h2><span></span>{{ $product->price }} €<span></span></h2>
    </div> <!-- col -->
    <div class="col-12 align-self-center"> <!-- col -->


@if(auth()->check())
        @if($user->restaurant_id === $category->restaurant_id)

            <a href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_product-{{$product->id}}" class="updateproduct text-center d-block mt-3">
                <i class="fa fa-edit"></i> Modifier
            </a>

  <form id="delete-form-{{ $product->id }}" action="{{ route('deleteprod', $product->id) }}" method="POST" enctype="multipart/form-data" class="delete-form">
        @csrf
        @method('delete')
        <small>
          <button type="button" class="text-danger mt-4 d-block" onclick="confirmDelete({{ $product->id }}, '{{ $product->name }}' )">
            <i class="fa fa-trash"></i> Supprimer
          </button>
        </small>
      </form>

      <script>
        function confirmDelete(categoryId, categoryName) {
          if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ( "+categoryName+"    "+categoryId+"  ) ?")) {
            document.getElementById('delete-form-' + categoryId).submit();
          }
        }
      </script>

@include('partial.crud.update-product')



            @endif
            @endif



{{--
  <div class="btn btn-add btn-p d-block" data-bs-toggle="modal" data-bs-target="#modal_produit_{{$product->id}}">
        Ajouter
      </div>
--}}


      <!-- btn -->
    </div> <!-- col -->
  </div> <!-- row -->
</div> <!-- product -->



 <div class="modal fade" id="modal_produit_{{$product->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true"><!-- Modal -->
      <div class="modal-dialog"> <!-- dialog -->
        <div class="modal-content"> <!-- content -->
          <div class="modal-header"> <!-- header -->
            <h5 class="modal-title">{{ $product->name }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div> <!-- header -->
          <div class="modal-body"> <!-- body -->
            <img class="w-100" src="{{ asset('images/products/'.$product->image )}}" alt="...">

            <p class="mt-3">{{ $product->content }}</p>
          </div> <!-- body -->
          <div class="modal-footer"> <!-- footer -->

          </div> <!-- footer -->
        </div> <!-- content -->
      </div> <!-- dialog -->
    </div><!-- Modal -->