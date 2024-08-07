<?php if (isset($_GET['show'])) : ?>
<style>

<?php $show = $_GET['show']; ?>

<?php if ($show == 'views') :?>

.produits_plus_vues,
.cats_plus_vues{
    display: none;
}


<?php endif; ?>


<?php if ($show == 'products') :?>

.nbrs_vues,
.cats_plus_vues{
    display: none;
}
.produits_plus_vues{
    flex: 0 0 100%;
    max-width: 100%;
}



<?php endif; ?>

<?php if ($show == 'categories') :?>

.nbrs_vues,
.produits_plus_vues{
    display: none;
}

.cats_plus_vues{
    flex: 0 0 100%;
    max-width: 100%;
}



<?php endif; ?>

</style>
<?php endif; ?>



<?php if (!isset($_GET['allviews'])) : ?>

<style>
    .nbrs_vues h3,
    #filter
    {display: none!important;}
</style>


<?php endif; ?>




<?php if (isset($_GET['exportAllToPDF'])) :?>

<div class="row">
    <div class="col-12">
        <div id="pdf-container"><h2>... chargement ...</h2></div>
        <!-- /#pdf-container -->

    </div>
    <!-- /.col-12 -->
</div>
<!-- /.row -->

 <?php endif; ?>



<div class="row" <?php if (isset($_GET['exportAllToPDF'])) :?> style="display: none" <?php endif; ?> >

    <div class="col-12 nbrs_vues">
        <div class="card-body">



<button id="exportAllToPDFButton" style="display: none;">Exporter toutes les données en PDF</button>


            <h6>Nombre de vues du Restaurant depuis le début : <strong>{{$restaurant->seen}}</strong> </h6>

            <div class="col-12 pb-5 mb-2" style="padding: 0;">

                <div class="btn-group btn-group-toggle" >
                    <label class="btn btn-sm btn-primary " id="0">
                        <input type="radio" name="options" id="radio-resto"  checked="">
                        <span class="d-block ">
                            <span class="d-block text-center" style="">
                               <a style="color: #fff" href="admin?task=stats&filter=1&show=views">
                                Aujourd'hui
                            </a>
                        </span>
                    </span>
                </label>

               {{--
 <label class="btn btn-sm btn-primary " id="0">
                    <input type="radio" name="options" id="radio-resto"  checked="">
                    <span class="d-block ">
                        <span class="d-block text-center" style="">
                           <a style="color: #fff" href="admin?task=stats&filter=7&show=views">
                            7 jours
                        </a>
                    </span>
                </span>
            </label>
                --}}

            <label class="btn btn-sm btn-primary " id="0">
                <input type="radio" name="options" id="radio-resto"  checked="">
                <span class="d-block ">
                    <span class="d-block text-center" style="">
                       <a style="color: #fff" href="admin?task=stats&filter=15&show=views">
                        15 jours
                    </a>
                </span>
            </span>
        </label>

        <label class="btn btn-sm btn-primary " id="0">
            <input type="radio" name="options" id="radio-resto"  checked="">
            <span class="d-block ">
                <span class="d-block text-center" style="">
                   <a style="color: #fff" href="admin?task=stats&filter=30&show=views">
                    30 jours
                </a>
            </span>
        </span>
    </label>
</div> <!-- btn-group-toggle -->
</div> <!-- /.col-12 -->

<div class="nbrs_vues">
<?php if (isset($_GET['filter'])) : ?>

@if ($viewStats)
<h2>Nombre de vues

    <?php if (isset($_GET['filter'])) : ?>
    <?php
    $filter = $_GET['filter'];
    ?>
    <?php
    if ($filter == '1') {
     echo "aujourd'hui";
 }else{
    echo "depuis ".$filter." jours";
}
?>
<?php endif; ?>

: <b>
   {{ $nbr_view }}
</b>
</h2>

<hr>
<h3>Nombre de vues de la semaine</h3>

<hr>
{{--
        <a href="?task=stats&filter=1&show=exportS" class="btn btn-fill btn-secondary">
                Export Excel</strong>
            </a>

             <a class="ml-4 btn btn-fill btn-info" href="?task=stats&filter=1&show=exportS_PDF">
                Export PDF</strong>
            </a>

    --}}
            <hr>

<div class="chart-area">
    <canvas id="filter"></canvas>
</div>



@else
<p>Pas de vues aujourd'hui.</p>
@endif

<?php endif; ?>

</div>
<!-- / -->

</div>



</div>
<!-- /.col-12 -->


<div class="col-12 col-md-6 produits_plus_vues ">
    <div class="card-body">
        <p>Produits les plus vus</p>
        <hr>
{{--
        <a href="?task=stats&filter=1&show=exportP" class="btn btn-fill btn-secondary">
                Export Excel</strong>
            </a>

            <a class="ml-4 btn btn-fill btn-info" href="?task=stats&filter=1&show=exportP_PDF">
                Export PDF</strong>
            </a>
            <hr>
          --}}
        <div class="chart-area">
            <canvas id="chart"></canvas>
        </div>
        <div class="">
            <table class="table tablesorter " id="">
                <thead class=" text-primary">
                    <tr>
                        <th>
                            Position
                        </th>
                        <th>
                            Nom
                        </th>
                        <th class="text-center">
                            Nombre de vues
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $position = 1;
                    @endphp
                    @foreach ($products->sortByDesc('seen') as $product)
                    <tr>
                        <td>
                            <strong>{{ $position }}</strong>
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td class="text-center">
                            {{ $product->seen }}
                        </td>
                    </tr>
                    @php
                    $position++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>
</div>
<!-- /.col-6 -->


<div class="col-12 col-md-6 cats_plus_vues">
    <div class="card-body">
        <p>Catégories les plus vues</p>
        <hr>
{{--
        <a href="?task=stats&filter=1&show=exportC" class="btn btn-fill btn-secondary">
                Export Excel</strong>
            </a>
     <a class="ml-4 btn btn-fill btn-info" href="?task=stats&filter=1&show=exportC_PDF">
                Export PDF</strong>
            </a>
            <hr>
          --}}
        <div class="chart-area">
            <canvas id="chart-cats"></canvas>
        </div>


        <div class="">
            <table class="table tablesorter " id="">
                <thead class=" text-primary">
                    <tr>
                        <th>
                            Position
                        </th>
                        <th>
                            Nom
                        </th>
                        <th class="text-center">
                            Nombre de vues
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $position = 1;
                    @endphp
                    @foreach ($mainCategories->sortByDesc('seen') as $category)
                    @if ($category->is_main)
                    <tr>
                        <td>
                            <strong>{{ $position }}</strong>
                        </td>
                        <td>
                            {{ $category->name }}
                        </td>
                        <td class="text-center">
                            {{ $category->seen }}
                        </td>
                    </tr>
                    @php
                    $position++;
                    @endphp
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>



</div>


</div>