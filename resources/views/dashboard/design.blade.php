<div class="card ">
    <div class="card-header">
        <h4 class="card-title">Apparence de votre restaurant</h4>
    </div>
    <form id="designForm" action="{{ route('updateDesign', $user->restaurant_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">



            <div class="col-6">
            <h5>Couleur de fond</h5>
            <div class="wrap_colors">

             @if ($design->theme)
             <input type="color" name="theme" id="theme" class="" value="{{ $design->theme }}">
             <span class="clear_color">
              <i class="tim-icons icon-simple-remove"></i>
          </span>
          @else
          <input type="text" name="theme" id="theme" class="" value="{{ $design->theme }}">
          <span class="clear_color">
              <i class="tim-icons icon-palette"></i>
          </span>
          @endif

      </div>
      <!-- /.wrap_colors -->
  </div>
  <!-- /.col-md-6 -->


  <div class="col-6">
    <h5>Couleur des textes</h5>

    <div class="wrap_colors">
      @if ($design->baseColor)
      <input type="color" name="baseColor" id="baseColor" class="" value="{{ $design->baseColor }}">
      <span class="clear_color">
          <i class="tim-icons icon-simple-remove"></i>
      </span>
      @else
      <input type="text" name="baseColor" id="baseColor" class="" value="{{ $design->baseColor }}">
      <span class="clear_color">
          <i class="tim-icons icon-palette"></i>
      </span>
      @endif

  </div>
  <!-- /.wrap_colors -->
</div>
<!-- /.col-md-6 -->

<div class="col-12">
    <h5>Couleur des titres</h5>
    <div class="wrap_colors">

       @if ($design->titleColor)
       <input type="color" name="titleColor" id="titleColor" class="" value="{{ $design->titleColor }}">
       <span class="clear_color">
          <i class="tim-icons icon-simple-remove"></i>
      </span>
      @else
      <input type="text" name="titleColor" id="titleColor" class="" value="{{ $design->titleColor }}">
      <span class="clear_color">
          <i class="tim-icons icon-palette"></i>
      </span>
      @endif


  </div>
  <!-- /.wrap_colors -->
</div>
<!-- /.col-md-6 -->

<div class="col-12">
  <div class="apercu">

    <div class="preview_phone_ext">
      <div class="preview_phone_int">

        <div class="preview_phone_banner" style="background-image: url({{$url}}img/default.png);"></div>
        <div class="preview_phone_title"></div>
        <div class="preview_phone_txt"></div>

        <div class="preview_phone_bts">
          <div class="preview_phone_btn"><span></span></div>
          <div class="preview_phone_btn"><span></span></div>
          <div class="preview_phone_btn"><span></span></div>
        </div>
        <!-- /.preview_phone_bts -->

      </div>
      <!-- /.preview_phone_int -->
    </div>
    <!-- /.preview_phone_ext -->


  </div>
  <!-- /.apercu -->
</div>
<!-- /.col-12 -->

<div class="col-12">
    <div class="card-footer">
        <button type="submit" class="btn btn-fill btn-primary">Mettre a jour</button>
    </div>
</div>
<!-- /.col-12 -->
</div>
</form>










</div>
