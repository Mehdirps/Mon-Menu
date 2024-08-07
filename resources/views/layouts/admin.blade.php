@if(auth()->check())
@if(auth()->user()->isSuperAdmin())
<?php $edit = ' <span>
<svg width="16px" height="16px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<g id="Complete">
<g id="edit">
<g>
<path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
<polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="green" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
</g>
</g>
</g>
</svg>
</span>'; ?>

<?php $see = '<span>
<svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
width="16px" height="16px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
<g>
<path fill="cyan" d="M63.934,31.645c-0.015-0.037-0.256-0.646-0.74-1.648C60.597,24.627,51.02,8.004,32,8.004
c-22.568,0-31.842,23.404-31.934,23.641c-0.089,0.231-0.089,0.487,0,0.719C0.158,32.6,9.432,56.004,32,56.004
c19.01,0,28.587-16.605,31.189-21.983c0.486-1.007,0.729-1.62,0.744-1.657C64.022,32.132,64.022,31.876,63.934,31.645z M32,54.004
c-19.686,0-28.677-19.123-29.917-22.001C3.321,29.121,12.288,10.004,32,10.004c19.686,0,28.677,19.123,29.917,22.001
C60.679,34.887,51.712,54.004,32,54.004z"/>
<path fill="cyan" d="M32,16.008c-8.837,0-16,7.163-16,16s7.163,16,16,16s16-7.163,16-16S40.837,16.008,32,16.008z M32,46.008
c-7.732,0-14-6.268-14-14s6.268-14,14-14s14,6.268,14,14S39.732,46.008,32,46.008z"/>
<path fill="cyan" d="M32,24.008c-4.418,0-8,3.582-8,8s3.582,8,8,8s8-3.582,8-8S36.418,24.008,32,24.008z M32,38.008
c-3.313,0-6-2.687-6-6s2.687-6,6-6s6,2.687,6,6S35.313,38.008,32,38.008z"/>
<path fill="cyan" d="M32,28.004c-0.553,0-1,0.447-1,1s0.447,1,1,1c1.104,0,2,0.896,2,2c0,0.553,0.447,1,1,1s1-0.447,1-1
C36,29.795,34.209,28.004,32,28.004z"/>
</g>
</svg>
</span>' ?>


<?php $trash = '<span><svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.99997 8H6.5M6.5 8V18C6.5 19.1046 7.39543 20 8.5 20H15.5C16.6046 20 17.5 19.1046 17.5 18V8M6.5 8H17.5M17.5 8H19M9 5H15M9.99997 11.5V16.5M14 11.5V16.5" stroke="red" stroke-linecap="round" stroke-linejoin="round"/></svg></span>' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tableau de bord</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  {{-- <link rel="stylesheet" href='{{ asset("css/admin.css" )}}'> --}}

  <style>
    body{
      font-size: 12px;
    }
    span svg{
      width: 16px;
      height: 16px;
      margin-right: 16px;
    }


    /* En-tête */
    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    header h1 {
      margin: 0;
    }

    nav ul {
      list-style: none;
          margin: 0;
    width: 100%;
    display: flex;
    margin-top: 14px;
    background: #d3a868;
    padding: 9px;
justify-content: space-between;
    }

    nav ul li {
      display: inline-block;
      margin-right: 20px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
    }

    /* Contenu principal */
    main {
      padding: 20px;
    }





    .dashboard-section h2 {
      margin: 0;
      margin-bottom: 10px;
    }

    .restaurant-list,
    .user-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .restaurant,
    .user {
      border: 1px solid #ccc;
      padding: 20px;
    }

    .restaurant h3,
    .user h3 {
      margin: 0;
    }

    .restaurant p,
    .user p {
      margin: 0;
      margin-bottom: 10px;
    }

    .restaurant a,
    .user a {
      display: inline-block;
      margin-right: 10px;
    }


  </style>

</head>
<body>
  <header>
    <!-- En-tête du tableau de bord -->
    <h1>Tableau de bord</h1>
    <nav>
      <!-- Menu de navigation -->
      <ul>
        <li><a href="{{route('admin')}}">Accueil</a></li>
        <li><a href="?task=restaurants">Restaurants</a></li>
        <li><a href="?task=users">Utilisateurs</a></li>
        <li><a href="{{route('logout')}}">Déconnexion</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <!-- Contenu principal -->
    <section class="dashboard-section">

<div class="container-fluid pt-1" id="accueil">

       <div class="row">
          <div class="col-12">


@if(isset($_GET['task']))
      @php $task = $_GET['task']; @endphp
    @include('layouts/admin-' . $task)
@else
          <h1>Bonjour {{$user->name}}</h1>
          <p>Lorem, ipsum dolor sit, amet consectetur adipisicing elit. Ex, nostrum. Amet deleniti et facere totam, esse minus eligendi voluptatem ipsa hic, cumque maxime voluptate, voluptatum. Explicabo, asperiores tenetur dolorum impedit.</p>
@endif


        </div>
        <!-- /.col-12 -->
       </div>
       <!-- /.row -->
    </section>

</main>

</div>
<!-- /.container -->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script></body>
</html>

@else

@endif
@else
@guest
<h1>Acces interdit</h1>
<script>window.location = "login";</script>
@endguest
@endif