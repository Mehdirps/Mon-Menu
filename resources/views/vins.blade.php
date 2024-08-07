@extends('layouts.app')

@section('content')








<div class="container-fluid pt-0 mt-0">
	<div class="row">

		<div class="col-4 col-sm-3 sidebar">
			<div class="wrap_logo">
				<a class="navbar-brand" href="http://localhost/restomenu/public/home">
					<img src="http://localhost/restomenu/public/img/logo.svg" alt="">
				</a>
			</div>

			<div class="col-12">
				<a href="#" class="reduire" id="reduire">Réduire le menu</a>
			</div>

			<div class="col col-categorie ">
				<div class="card"> <!-- card -->

					<div class="wrap_img_prod">

						<a href="http://localhost/restomenu/public/home/1-hamburgers" title="">
							<img src="http://localhost/restomenu/public/img/hamburgers.png" alt="Hamburgers">
							<h4>Hamburgers</h4>
						</a>
						<a href="#edit" title="éditer" data-bs-toggle="modal" data-bs-target="#modal_category_1">
							<i class="fa fa-edit"></i> éditer
						</a>
					</div>
				</div> <!-- card -->
			</div>
			<div class="col col-categorie ">
				<div class="card"> <!-- card -->
					<div class="wrap_img_prod">
						<a href="http://localhost/restomenu/public/home/4-pizzas" title="">
							<img src="http://localhost/restomenu/public/img/pizzas.png" alt="Pizzas">
							<h4>Pizzas</h4>
						</a>
						<a href="#edit" title="éditer" data-bs-toggle="modal" data-bs-target="#modal_category_4">
							<i class="fa fa-edit"></i> éditer
						</a>
					</div>

				</div> <!-- card -->
			</div>
			<div class="col col-categorie active">


				<div class="card"> <!-- card -->

					<div class="wrap_img_prod">

						<a href="http://localhost/restomenu/public/home/7-boissons" title="">
							<img src="http://localhost/restomenu/public/img/boissons.png" alt="Boissons">
							<h4>Boissons</h4>
						</a>
						<a href="#edit" title="éditer" data-bs-toggle="modal" data-bs-target="#modal_category_7">
							<i class="fa fa-edit"></i> éditer
						</a>
					</div>

				</div> <!-- card -->
			</div>
			<div class="col col-categorie ">
				<div class="card"> <!-- card -->
					<div class="wrap_img_prod">

						<a href="http://localhost/restomenu/public/home/12-formule-midi" title="">
							<img src="http://localhost/restomenu/public/img/formule-midi.png" alt="Formule Midi">
							<h4>Formule Midi</h4>
						</a>
						<a href="#edit" title="éditer" data-bs-toggle="modal" data-bs-target="#modal_category_12">
							<i class="fa fa-edit"></i> éditer
						</a>
					</div>

				</div> <!-- card -->
			</div>
		</div> <!-- sidebar -->

		<div class="col-8 col-sm-9 main">
			<div class="row"> <!-- row -->
				<div class="col-12 wrap_img_cat wrap_img_cat_vins"> <!-- image cat -->
					<div class="noise"></div>
					<h1>Vins</h1>

					<img src="{{ asset("img/still-life-with-red-wine.jpg" )}}" alt="Boissons">
				</div> <!-- image cat -->
				<h1 class="cat_name">Accueil / <a href="home/7-boissons" title="">Boissons</a>  / Vins</h1>
			</div> <!-- row -->

			<div class="col col-categorie col-12 wrap_card_cat wrap_card_cat-1">
	
	<div class="row align-items-center">
					

<div class="col-12">
	
<table class="table_vins table" width="100%" border="1">
  <tbody>
    <tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>14cl</th>
      <th>50cl</th>
      <th>75cl</th>
      <th>150cl</th>
      <th>300cl</th>
    </tr>
   

   @for ($i = 0; $i < 10; $i++)


 <tr>
      <td>Chateau untel</td>
      <td>
      	<span class="rouge"></span>
      	<span class="rose"></span>
      	<span class="blanc"></span>
      </td>
      <td>4€</td>
      <td>5 €</td>
      <td>8.5 €</td>
      <td>15.5 €</td>
      <td>40.5 €</td>
    </tr>

   @endfor
  </tbody>
</table>

</div>

	</div>



			</div> <!-- card -->

			<div class="footer">Propulsé par maplaque-nfc.fr</div>
		</div> <!-- .main -->
	</div> <!-- row -->

</div> <!-- container -->
@endsection

@section('footer-js')

<script>
	$('#reduire').click();
</script>

@endsection