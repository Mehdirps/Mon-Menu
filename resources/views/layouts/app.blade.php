 <?php $url = config('app.url'); ?>
 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>
         @yield('title') - MonMenu.io
     </title>
     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
     <link rel="shortcut icon" href="{{ $url }}img/favicon.png" type="image/x-icon">
     <!-- Scripts -->


     {{--

 <link rel="stylesheet" href="{{ $url }}styles/css/styles.css">

        --}}
     <link rel="stylesheet" href="{{ $url }}styles/css/new.css">





     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
         integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
         crossorigin="anonymous"
         referrerpolicy="no-referrer" />




     @yield('header-css')


     {{-- @if (isset($design))
         <style>
             @if ($design->theme)

                 html,
                 body,
                 .restaurant .restaurant-content .restaurant-products,
                 .product-details,
                 .slide_prods,
                 .slide_prods,
                 .slide_cats,
                 .selector_menu_section,
                 .new_resto_list_cats li a {
                     background-color: {{ $design->theme }};
                 }

             @endif

             @if ($design->baseColor)
                 .restaurant-desc,
                 .restaurant .restaurant-header .restaurant-infos,
                 .page-cats .product-infos p,
                 p.product-details-content,
                 .restaurant .restaurant-content .restaurant-products .product-list .product p.product_price,
                 .subCategory_link,
                 .restaurant-products .cat-content,
                 p.product-content,
                 .p_price,
                 .slide_prods h2 {
                     color: {{ $design->baseColor }} !important;
                 }

                 .restaurant-footer .footer-container .restaurant-footer-social-links svg {
                     color: {{ $design->baseColor }}
                 }

                 .page-cats .product {
                     border-color: {{ $design->baseColor }}
                 }
             @endif

             @if ($design->baseFamily)
                 html,
                 body {
                     font-family: {{ $design->baseColor }} !important;
                 }

             @endif

             @if ($design->titleColor)
                 h1,
                 h2,
                 h3,
                 h4,
                 h5,
                 h6,
                 .restaurant-name h1 a,
                 .selector_menu>li a {
                     color: {{ $design->titleColor }} !important;
                 }

                 .restaurant-name,
                 .sub_category,
                 .resto_cat.active .resto_cat_img,
                 .selector_menu>li {
                     border-color: {{ $design->titleColor }};
                 }
             @endif

             @if ($design->titleFamily)
                 h1,
                 h2,
                 h3,
                 h4,
                 h5,
                 h6 {
                     font-family: {{ $design->titleFamily }} !important;
                 }
             @endif
         </style>
     @endif --}}


     <!-- Google tag (gtag.js) -->
     <script async src="https://www.googletagmanager.com/gtag/js?id=G-9Z9VHBG5H0"></script>
     <script>
         window.dataLayer = window.dataLayer || [];

         function gtag() {
             dataLayer.push(arguments);
         }
         gtag('js', new Date());

         gtag('config', 'G-9Z9VHBG5H0')
     </script>


 </head>

 <body class="dark">
     @if (session('success'))
         <script>
             alert('Votre commande à été envoyé avec succès !')
             sessionStorage.removeItem("cart");
         </script>
     @endif
     <div id="app">
         <main class="">
             @if ($restaurant->cart)
                 <div class="cartIcon">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-basket-fill" viewBox="0 0 16 16">
                         <path
                             d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
                     </svg>
                     <p>Mon panier</p>

                 </div>
                 <div class="cart" data-restau_id="{{ $restaurant->id }}">
                     <div class="cart-content">
                         <h3>Voici ton panier !</h3>
                         <span class="close-cart">Fermer</span>
                         <div class="list"></div>
                     </div>
                     <div class="form">
                         <h2>Vous souhaitez valider votre panier ? Remplissez simplement le formulaire ci-dessous</h2>
                         <form action="{{ route('valideCart') }}" method="POST">
                             @csrf
                             @method('POST')
                             <div>
                                 <label for="name">Nom</label>
                                 <input type="text" id="name" name="name" required>
                             </div>
                             <div>
                                 <label for="phone">Téléphone</label>
                                 <input type="tel" id="phone" name="phone"
                                     pattern="[0-9]{10}|[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}"
                                     placeholder="ex : 0606060606 ou 06 06 06 06 06" required />
                             </div>
                             <div>
                                 <label for="email">E-mail</label>
                                 <input type="mail" id="email" name="email" required>
                             </div>
                             <div>
                                 <label for="livraison">Instruction de livraison</label>
                                 @if ($restaurant->cart_instructions)
                                     <p><small>Infos du restaurant :
                                             <em>{{ $restaurant->cart_instructions }}</em></small></p>
                                 @endif
                                 <textarea id="livraison" name="livraison" cols="30" rows="10"
                                     placeholder="Indiquer vos préférences de livraison, ou de récéption ainsi que la date et l'heure souhaitée"
                                     required></textarea>
                             </div>
                             <input type="hidden" name="cart" id="cart-input">
                             <input type="hidden" name="restaurant_id" value={{ $restaurant->id }}>
                             <button>Valider mon panier</button>
                         </form>
                     </div>
                 </div>
                 <script>
                     const cart = document.querySelector('.cart');
                     const restauId = cart.getAttribute('data-restau_id');

                     function sauvegarderPanierEnSession(cart) {
                         sessionStorage.setItem(`cart${restauId}`, JSON.stringify(cart));
                         mettreAJourPrixTotalPanier()
                         const cartValue = sessionStorage.getItem(`cart${restauId}`);
                         document.getElementById('cart-input').value = cartValue;
                     }

                     function mettreAJourPrixTotalPanier() {
                         const cart = JSON.parse(sessionStorage.getItem(`cart${restauId}`)) || [];

                         const totalPrice = cart.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2);

                         const totalPriceCell = document.querySelector('.cart-row-total .cart-cell:last-child');
                         if (totalPriceCell) {
                             totalPriceCell.textContent = totalPrice;
                         }
                     }

                     function afficherPanier() {
                         const cart = JSON.parse(sessionStorage.getItem(`cart${restauId}`)) || [];
                         const cartDiv = document.querySelector('.list');

                         const table = document.createElement('table');
                         const tableHeader = document.createElement('thead');
                         const tableBody = document.createElement('tbody');

                         const headerRow = document.createElement('tr');
                         const productNameHeader = document.createElement('th');
                         productNameHeader.textContent = 'Produit';
                         const quantityHeader = document.createElement('th');
                         quantityHeader.textContent = 'Quantité';
                         const priceTotalHeader = document.createElement('th');
                         priceTotalHeader.textContent = 'Prix Total'; // Ajout de la colonne "Prix Total"
                         const actionHeader = document.createElement('th');
                         actionHeader.textContent = 'Actions';

                         headerRow.appendChild(productNameHeader);
                         headerRow.appendChild(quantityHeader);
                         headerRow.appendChild(priceTotalHeader); // Ajout de l'en-tête de la colonne "Prix Total"
                         headerRow.appendChild(actionHeader);
                         tableHeader.appendChild(headerRow);
                         table.appendChild(tableHeader);

                         table.classList.add('cart-table');
                         tableHeader.classList.add('cart-header');
                         tableBody.classList.add('cart-body');
                         headerRow.classList.add('cart-row-header');
                         productNameHeader.classList.add('cart-cell-header');
                         quantityHeader.classList.add('cart-cell-header');

                         cart.forEach((item, index) => {
                             const row = document.createElement('tr');
                             row.classList.add('cart-row');
                             if (index === 0) {
                                 row.classList.add('cart-row-first');
                             }

                             const productNameCell = document.createElement('td');
                             productNameCell.classList.add('cart-cell');
                             productNameCell.textContent = item.productName;

                             const quantityCell = document.createElement('td');
                             quantityCell.classList.add('cart-cell');
                             quantityCell.textContent = item.quantity;

                             const priceTotalCell = document.createElement('td');
                             priceTotalCell.classList.add('cart-cell');
                             const priceTotal = (item.price * item.quantity).toFixed(2);
                             priceTotalCell.textContent = priceTotal + '€';
                             const actionCell = document.createElement('td');
                             actionCell.classList.add('cart-cell');

                             const increaseButton = document.createElement('button');
                             increaseButton.textContent = '+';
                             increaseButton.addEventListener('click', () => {
                                 item.quantity++;
                                 quantityCell.textContent = item.quantity;
                                 const newPriceTotal = (item.price * item.quantity).toFixed(2);
                                 priceTotalCell.textContent = newPriceTotal;
                                 sauvegarderPanierEnSession(cart);
                             });

                             const decreaseButton = document.createElement('button');
                             decreaseButton.textContent = '-';
                             decreaseButton.addEventListener('click', () => {
                                 if (item.quantity > 1) {
                                     item.quantity--;
                                     quantityCell.textContent = item.quantity;
                                     const newPriceTotal = (item.price * item.quantity).toFixed(2);
                                     priceTotalCell.textContent = newPriceTotal;
                                     sauvegarderPanierEnSession(cart);
                                 }
                             });

                             const deleteButton = document.createElement('button');
                             deleteButton.textContent = 'Supprimer';
                             deleteButton.addEventListener('click', () => {
                                 cart.splice(index, 1);
                                 row.remove();
                                 sauvegarderPanierEnSession(cart);
                             });

                             actionCell.appendChild(increaseButton);
                             actionCell.appendChild(decreaseButton);
                             actionCell.appendChild(deleteButton);

                             row.appendChild(productNameCell);
                             row.appendChild(quantityCell);
                             row.appendChild(priceTotalCell);
                             row.appendChild(actionCell);
                             tableBody.appendChild(row);
                         });

                         const totalPrice = cart.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2);

                         const totalPriceRow = document.createElement('tr');
                         totalPriceRow.classList.add('cart-row-total');

                         const totalPriceCell = document.createElement('td');
                         totalPriceCell.classList.add('cart-cell');
                         totalPriceCell.colSpan = 2;
                         totalPriceCell.textContent = 'Prix Total du Panier';

                         const totalPriceValueCell = document.createElement('td');
                         totalPriceValueCell.classList.add('cart-cell');
                         totalPriceValueCell.textContent = totalPrice + '€';

                         totalPriceRow.appendChild(totalPriceCell);
                         totalPriceRow.appendChild(totalPriceValueCell);

                         tableBody.appendChild(totalPriceRow);

                         const style = document.createElement('style');
                         style.textContent = `
                         .cart-table {
                             border-collapse: collapse;
                             width: 100%;
                         }
                         .cart-row {
                             border-bottom: 1px solid #ddd;
                         }
                         .cart-row-first {
                             /* Styles spéciaux pour la première ligne si nécessaire */
                         }
                         .cart-row-total {
                             font-weight: bold;
                         }
                         .cart-cell {
                             padding: 8px;
                         }
                         .cart-cell-header {
                             text-align: left;
                         }
                         button {
                             padding: 4px 8px;
                             cursor: pointer;
                         }
                    `;

                         document.head.appendChild(style);

                         table.appendChild(tableBody);

                         while (cartDiv.firstChild) {
                             cartDiv.removeChild(cartDiv.firstChild);
                         }
                         cartDiv.appendChild(table);
                         sauvegarderPanierEnSession(cart);
                     }

                     const cartBtn = document.querySelector('.cartIcon');
                     const closeBtn = document.querySelector('.close-cart');
                     cartBtn.addEventListener('click', () => {
                         const cart = document.querySelector('.cart');
                         if (!cart.classList.contains('cartActive')) {
                             cart.classList.add('cartActive');
                             window.scrollTo({
                                 top: 0,
                                 behavior: 'smooth'
                             });
                             afficherPanier();
                         } else {
                             cart.classList.remove('cartActive');
                         }
                     })
                     closeBtn.addEventListener('click', () => {
                         const cart = document.querySelector('.cart');
                         cart.classList.remove('cartActive');
                         window.scrollTo({
                             top: 0,
                             behavior: 'smooth'
                         });
                     })
                 </script>
             @endif
             @yield('content')
         </main>
     </div>
     <style>
         .cartIcon {
             position: fixed;
             top: 20px;
             /* width: 30px; */
             /* height: 30px; */
             background-color: white;
             padding: 5px;
             display: flex;
             justify-content: center;
             align-items: center;
             transform: translate(-50%, -50%);
             left: 50%;
             cursor: pointer;
             z-index: 200000000000;
             display: flex;
             flex-direction: row;
             gap: 5px;
             align-items: center;
             justify-content: center;
         }

         .cartIcon svg {
             width: 20px;
             height: 20px;
             color: black;
         }

         .cartActive {
             /* position: fixed;
             top: 0;
             max-height: 100vh;
             overflow: scroll; */
             /* width: 100%;
             max-width: 1000px; */
             padding: 20px;
             background-color: white;
             display: flex !important;
             flex-wrap: wrap;
             /* z-index: 100000; */
             /* border-radius: 0 30px 0 30px; */
             border: 5px solid #d2a967;

         }

         .form h2 {
             font-size: 1rem;
         }

         .cart span {
             display: block;
             margin: 15px;
         }

         .form button {
             padding: 10px 20px;
             background-color: #d2a967;
             color: white;
             border: none;
             border-radius: 20px;
         }

         .cart-content,
         .form {
             flex: 1;
             min-width: 300px;
             max-width: 450px;
             padding: 20px 0;
         }

         .form {
             display: flex;
             flex-direction: column;
             justify-content: center;
             align-items: center;
             gap: 15px;
             text-align: center;
         }

         .form form div {
             display: flex;
             flex-direction: column;
             margin: 15px 0;
         }

         .form input,
         .form textarea {
             padding: 5px 10px;
             border: 2px solid #d2a967;
             border-radius: 20px;
         }

         .form textarea {
             resize: none;
         }

         .cart {
             display: none
         }
     </style>

     <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
     <script>
         Weglot.initialize({
             api_key: 'wg_d5a24893c086ada50a8699cd5a9ce4f31'
         });
     </script>

     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <script>
         var sidebar = $('.sidebar');
         var main = $('.main');

         $('#reduire').click(function() {
             sidebar.toggleClass('mini-side');
             main.toggleClass('max-main');
         })

         $('#reduire').click();
     </script>
     @yield('footer-js')

 </body>

 </html>
