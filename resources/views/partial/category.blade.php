@if($category)
@if($category->products()->count() > 0 || $category->childs )




<div class="col col-categorie {{ $class }}">
	<div class="card"> <!-- card -->
		<div class="wrap_img_prod">
			<a href="{{ route('singlecat' , [ $restaurant->id, $category->id, $category->slug]) }}" title="">
							<span class="curved-container">
								<h4>{{ $category->name }}</h4>
							</span>
			</a>
			<!-- lien -->

			@if(auth()->check())
				@if($user->restaurant_id === $category->restaurant_id)

			<a href="#" title="" data-bs-toggle="modal" data-bs-target="#modal-update_category_{{$category->id}}" id="idupdatecat">
				<i class="fa fa-edit"></i> Modifier
			</a>
			<!-- lien -->
			<br>

			<form id="delete-form-{{ $category->id }}" action="{{ route('deletecat', $category->id) }}" method="POST" enctype="multipart/form-data" class="delete-form">
				@csrf
				@method('delete')
				<small>
					<button type="button" class="text-danger mt-4 d-block" onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}' )">
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

			<!-- Modal -->
			<div class="modal fade" id="modal-update_category_{{$category->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
				<div class="modal-dialog"> <!-- dialog -->
					<div class="modal-content"> <!-- content -->
						<div class="modal-header"> <!-- header -->
							@if($category->name == 'Ma première catégorie')
							<h5 class="modal-title">Création d'une categorie </h5>
							@else
							<h5 class="modal-title">Mettre à jour une categorie </h5>
							@endif
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div> <!-- header -->
						<form id="" action="{{ route('updatecat', $category->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<!-- modal-body -->
							<div class="modal-body">
								<!-- form-group -->
								<div class="form-group">
									<label for="name">Nom de la catégorie</label>
									<input type="text"
									class="form-control"
									id="name"
									name="name"
									required="required"
									@if($category->name == 'Ma première catégorie')
									value=""
									placeholder="Ma première catégorie"

									@else
									placeholder="Nom de la catégorie"
									value="{{ $category->name }}"
									@endif
									>
								</div>
								<!-- form-group -->

								<!-- form-group -->
								<div class="form-group mt-4">
									<img id="imagePreview" src="#" alt="Aperçu de l'image" class="mb-4" style="display: none;width: 100%;">
									<label for="image">Image</label>
									<input type="file" class="form-control-file" id="image" name="image">
								</div>
								<!-- form-group -->

								<input type="hidden" name="parent_id" value="{{ $currentCategory->id }}">
							</div>
							<!-- modal-body -->
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">
									@if($category->name == 'Ma première catégorie')
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
				@endif
				@endif

		</div>
	</div> <!-- card -->
</div> <!-- col-categorie -->


@endif
@endif
