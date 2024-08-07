<?php
/*header('Location: https://monmenu.io/');*/
$url = config('app.url'); ?>

@extends('layouts.new-app')


@section('app-content')


<style>


      .header .navbar{
        display: none;
    }

ul#primary-menu {
    display: flex;
    gap: 20px;
}

ul#primary-menu a {
    text-decoration: none;
    color: #000;
}

@media(max-width:830px){
   .vitrine .header .container
    {
        flex-direction:column;

    }

ul#primary-menu{
    margin-top:25px;
    font-size:14px
}


}
</style>

    <section class="main-first-section">
        <div class="main-first-section-container">
            <div class="container">
                <div class="main-first-section-content">
                    <h1>MonMenu.io, menu en ligne et QrCode pour donner de la visibité et digitaliser votre établissement
                    </h1>
                    <div class="text-button">
                        <p>Avec <strong>MonMenu.io</strong> vous aurez possibilité de mettre en <strong>ligne</strong> votre
                            menu pour qu'il soit visible
                            par
                            tous
                            et de
                            n’importe ou. <strong>Gérer votre menu</strong> n’auras jamais été <strong>aussi simple
                                !</strong></p>
                        <a href="{{ route('register') }}" class="try-btn">Essayer dés maintenant !</a>
                    </div>
                </div>
                <figure class="main-first-section-img">
                    <img src="{{ $url }}img/vitrine/application-resto-2.svg" alt="Image d'illustration MomMenu">
                </figure>
            </div>
        </div>
        <div class="main-first-section-text">
            <div class="container">
                <h2>Simple et efficace. Remplissez votre menu simplement et rapidement !</h2>
                <p><strong>MonMenu.io</strong>, facile à prendre en main, propose une <strong>solution digitale</strong> qui
                    vous permet en
                    quelques
                    minutes de créer votre <strong>menu en ligne</strong> et générer le<strong> QrCode </strong>de votre
                    menu.</p>
                <p>Mettez à jour votre <strong>menu</strong> depuis n’importe quels endroits ou terminals en temps réel. Et
                    afin
                    d’être
                    le plus fonctionnel possible, une <strong>interface d’administration</strong> vous est dédiée. Vous
                    hésitez
                    encore ?
                    Découvrez les points forts de<strong> MonMenu.io</strong>.</p>
                <a href="{{ $url }}le-bistrot-de-charles/2" class="exemple-menu-btn">Voir un menu d'exemple</a>
            </div>
        </div>
    </section>
    <section class="main-presentation-section">
        <div class="container">
            <h2>Un menu en ligne c’est ?</h2>
            <div class="main-section-items-container">
                <article class="main-section-item">
                    <img src="{{ $url }}img/vitrine/illustration-visibilite.svg" alt="illustration visibilité"
                        width="232px" height="150px">
                    <h3>Une meilleure visibilité</h3>
                    <p>Plus de visibilité = plus de clients</p>
                </article>
                <article class="main-section-item">
                    <img src="{{ $url }}img/vitrine/illustration-ecologique.svg" alt="illustration ecologique"
                        width="225px" height="150px">
                    <h3>Plus écologique</h3>
                    <p>Fini les menus imprimés</p>
                </article>
                <article class="main-section-item">
                    <img src="{{ $url }}img/vitrine/illustration-flexible.svg" alt="illustration flexible"
                        width="232px" height="150px">
                    <h3>Plus flexible</h3>
                    <p>Une modification ? Un produit à ajouter ? Facile !</p>
                </article>
                <article class="main-section-item">
                    <img src="{{ $url }}img/vitrine/illustration-efficacite.svg" alt="illustration efficacite"
                        width="232px" height="150px">
                    <h3>Efficacité</h3>
                    <p>Permettez à vos clients de choisir le plats avant meme d’arriver dans votre etablissenemt</p>
                </article>
            </div>
            <a href="{{ route('register') }}" class="try-btn">Essayer dés maintenant !</a>
        </div>
    </section>
    <section class="main-souscription-section">
        <div class="container">
            <h2>Comment souscrire à MonMenu.io ?</h2>
            <div class="main-section-items-container">
                <article class="main-section-item">
                    <img src="{{ $url }}img/vitrine/illustration-compte.svg" alt="illustration compte"
                        width="232px" height="150px">
                    <h3>1. Créer un compte</h3>
                    <p>Pendant la création de votre compte vous pourrez remplir directement les informations de
                        votre restaurant !</p>
                </article>
                <article class="main-section-item">
                    <img src="{{ $url }}img/vitrine/illustration-souscription.svg" alt="illustration souscription"
                        width="232px" height="150px">
                    <h3>2. Souscription</h3>
                    <p>Une fois votre compte créé vous serez redirigé vers la boutique pour vous abonné à MonMenu.io
                        (sans engagement)
                    </p>
                </article>
                <article class="main-section-item">
                    <img src="{{ $url }}img/vitrine/illustration-remplissage.svg" alt="illustration remplissage"
                        width="232px" height="150px">
                    <h3>3. Remplissage</h3>
                    <p>Maintenant que vous êtes abonné vous pouvez commencer à remplir votre menu depuis votre
                        panneau de controle ! </p>
                </article>
            </div>
            <a href="{{ route('register') }}" class="try-btn">Essayer dés maintenant !</a>
        </div>
    </section>
    <section class="main-video-section">
        <div class="container">
            <h2>Comment fonctionne MonMenu ?</h2>
            <p>Voici une vidéo de démonstration</p>
            <div class="video"style="position:relative;">
                <img src="{{ $url }}images/image-video.webp" alt="Image vidéo de présentation"
                    style="width: 100%;height:515px; object-fit:contain;">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"
                    style="position: absolute; transform:translate(-50%,-50%); top:50%;left:50%;">
                    <path fill="red"
                        d="m10 15l5.19-3L10 9v6m11.56-7.83c.13.47.22 1.1.28 1.9c.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83c-.25.9-.83 1.48-1.73 1.73c-.47.13-1.33.22-2.65.28c-1.3.07-2.49.1-3.59.1L12 19c-4.19 0-6.8-.16-7.83-.44c-.9-.25-1.48-.83-1.73-1.73c-.13-.47-.22-1.1-.28-1.9c-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83c.25-.9.83-1.48 1.73-1.73c.47-.13 1.33-.22 2.65-.28c1.3-.07 2.49-.1 3.59-.1L12 5c4.19 0 6.8.16 7.83.44c.9.25 1.48.83 1.73 1.73Z" />
                </svg>
            </div>
        </div>
    </section>
    <section class="main-abonnements-section">
        <div class="container">
            <h2>Abonnements et formules</h2>
            <div class="main-abonnements-section-items-container">
                <article class="main-section-abonnements-item">
                    <h3>Abonnement MonMenu <br> (sans engagement)</h3>
                    <h4>Fonctionnalités :</h4>
                    <p>Créer des établissement (à volonté)</p>
                    <p>Créer et gérer le menu de chaque établissement</p>
                    <p>Statistiques pour chaque établissement</p>
                    <p>Génération de QrCode pour chaque menu</p>
                    <p class="main-section-abonnements-item-price">19.99€ HT / mois</p>
                    <a class="try-btn" href="{{ route('register') }}" target="_blank">Je l'essaie</a>
                </article>
                <article class="main-section-abonnements-item">
                    <h3>Abonnement MonMenu <br> (sans engagement) + remplissage</h3>
                    <h4>Fonctionnalités :</h4>
                    <p>Créer des établissement (à volonté)</p>
                    <p>Créer et gérer le menu de chaque établissement</p>
                    <p>Statistiques pour chaque établissement</p>
                    <p>Génération de QrCode pour chaque menu</p>
                    <p class="main-section-abonnements-item-plus">+</p>
                    <p>Nous créer votre menu pour vous !
                        Nous nous occupons de remplir votre
                        menu avec vos catégories, produits,
                        informations et tout le reste</p>
                    <p class="main-section-abonnements-item-price">19.99€ HT / mois + 99€ HT (remplissage)</p>
                    <a class="try-btn" href="{{ route('register') }}" target="_blank">Je l'essaie</a>
                </article>
                <article class="main-section-abonnements-item">
                    <h3>Support de table et Plaque NFC</h3>
                    <p>Sticker QrCode</p>
                    <p>Sticker QrCode + NFC</p>
                    <p>Plaque ronde QrCode</p>
                    <p>Plaque ronde QrCode + NFC</p>
                    <p>Plaque NFC Avis Google 12x12cm</p>
                    <p>Plaque NFC Duo Google/Tripadvisor 12x12cm</p>
                    <p>Plaque NFC Menu 12x12cm</p>
                    <p>Plaque NFC Tripadvisor 12x12cm</p>
                    <p class="main-section-abonnements-item-price">A partir de 2.50€ HT / l'unité</p>
                    <a class="try-btn" href="https://monmenu.io/" target="_blank">Je
                        l'essaie</a>
                </article>
            </div>
        </div>
    </section>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $('.header').load('https://monmenu.io/ .header .container', function () {
       $('.header .navbar').css('display', 'flex');
    });
</script>


    <script>
        const videoDiv = document.querySelector('.video');

        videoDiv.addEventListener('click', () => {
            videoDiv.innerHTML = `<iframe width="100%" height="320" src="https://www.youtube.com/embed/ba5ywF6cby4?rel=0&autoplay=1&volume=10"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>`;
        })
    </script>
@endsection
