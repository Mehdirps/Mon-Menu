@extends('layouts.app')

@section('content')


<div class="container container_home">
  <!-- container -->
  <div class="row justify-content-center">
    <!-- row -->
    <div class="col-12">
      <h3>{{ $currentCategory->name }}</h3>
    </div>
    <hr>
    <div class="row justify-content-center">
      <!-- row -->
      <div class="col-7 col-md-9">
        <!-- Content -->
        <div class="row justify-content-center">
          <!-- row -->
          @foreach ($products as $product)
          <div class="card col-md-6 col-xl-4 " >
            <div class="wrap_card">
              <div class="wrap_img">
                <img class="card-img-top" src="https://assets.hellofresh.com/us/cms/plans/VeggieJumble-Recipe-700x700.png" alt="...">
                <div class="card_price">
                  {{ $product->price }} €
                </div>
              </div>
              <div class="card-body">
                <h5 class="card-title text-center mb-4  ">
                  {{ $product->name }}
                </h5>
               


               {{--

 <div class="btn btn-add btn-success d-block" data-bs-toggle="modal" data-bs-target="#modal_{{$product->id}}">
                  Ajouter
                </div>


               --}}
              </div>
              

               {{--
              <div class="modal fade" id="modal_{{$product->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">{{$product->id}} </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <img class="w-100" src="https://assets.hellofresh.com/us/cms/plans/VeggieJumble-Recipe-700x700.png" alt="...">
                      <p>{{ $product->content }}</p>
                      <form action="">
                        <input type="number" placeholder="Quantité" name="" min="1">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary">Ajouter au panier</button>
                    </div>
                  </div>
                </div>
              </div>
                            --}}
            </div>
          </div>
          @endforeach
        </div>
        <!-- row -->
      </div>
      <!-- Content -->
      <div class="col-5 col-md-3">
        <!-- Sidebar -->
        <div class="position-sticky sidebar-sticky">
          <div class="wrap_basket_sidebar">
            <h3>Panier</h3>
          </div>
        </div>
      </div>
      <!-- Sidebar -->
    </div>
    <!-- row -->
  </div>
  <!-- row -->
</div>
<!-- container -->
@endsection
