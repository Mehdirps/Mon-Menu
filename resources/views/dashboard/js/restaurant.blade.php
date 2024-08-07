
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>

    $('.sharebtn').click(function () {
        if (window.navigator.share) {
          navigator.share({
            title: 'Retrouvez moi sur monmenu.io',
            text: '{{$restaurant->name}}',
            url: '{{ route('restaurantByName', [Str::slug($restaurant->name), $restaurant->id]) }}',
        }).catch(function () {
            $('.sharings').show();
        });
    } else {
      $('.sharings').show();
      $('.sharebtn').hide();
  }
})



    $('.btn-group-toggle input').change(function () {
        id = $(this).attr('id');

        if (id == 'radio-resto') {
            $('.socials,.hours').stop().slideUp();
            $('.base').stop().slideDown();
            $('.info_title').text('les informations');
            newUrl = '?task=restaurant&show=base';
            history.pushState({}, '', newUrl);

            $('#updateresto').click();
        }else if (id == 'radio-social'){
            $('.base,.hours').stop().slideUp();
            $('.socials').stop().slideDown();
            $('.info_title').text('les réseaux sociaux');
            newUrl = '?task=restaurant&show=social';
            history.pushState({}, '', newUrl);
        }else{
           $('.socials,.base').stop().slideUp();
           $('.hours').stop().slideDown();
           $('.info_title').text('les horaires');
           newUrl = '?task=restaurant&show=hours';
           history.pushState({}, '', newUrl);

       }


   })


    hours = {
        lundi       : $('.input-lundi').val(),
        mardi       : $('.input-mardi').val(),
        mercredi    : $('.input-mercredi').val(),
        jeudi       : $('.input-jeudi').val(),
        vendredi    : $('.input-vendredi').val(),
        samedi      : $('.input-samedi').val(),
        dimanche    : $('.input-dimanche').val()
    }



    $('.remove-hour').change(function () {
        checked = this.checked;
        day = $(this).data('remove');

        console.log('checked', checked);

        if (checked) {
            $('.input-' + day).val('');
            $('.input-' + day).attr('placeholder','Fermé');
        } else {
            $('.input-' + day).val(hours[day]);
        }
    });

    $('.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 15,
        minTime: '00:00',
        maxTime: '23:45',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });



// Écouteur d'événement sur la case à cocher "Fermé"
$('.remove-hour').change(function() {
    var inputHour = $(this).closest('.row').find('.input-hour');
    if ($(this).is(':checked')) {
        inputHour.val('');
    }
});




var lundiValue      = '{{$user->restaurant->lundi}}';
var mardiValue      = '{{$user->restaurant->mardi}}';
var mercrediValue   = '{{$user->restaurant->mercredi}}';
var jeudiValue      = '{{$user->restaurant->jeudi}}';
var vendrediValue   = '{{$user->restaurant->vendredi}}';
var samediValue     = '{{$user->restaurant->samedi}}';
var dimancheValue   = '{{$user->restaurant->dimanche}}';

if (lundiValue) {
    var horaires = lundiValue.split('-');

    console.log('horaires', horaires );

    if (horaires.length) {
        var ouvertureMatin = horaires[0];
        var fermetureMatin = horaires[1];
        var ouvertureApresmidi = horaires[2];
        var fermetureApresmidi = horaires[3];

        $('#lundi-matin-ouverture').val(ouvertureMatin);
        $('#lundi-matin-fermeture').val(fermetureMatin);
        $('#lundi-apresmidi-ouverture').val(ouvertureApresmidi);
        $('#lundi-apresmidi-fermeture').val(fermetureApresmidi);
    }
}

if (mardiValue) {
    Mardihoraires = mardiValue.split('-');

    console.log('horaires', Mardihoraires );

    if (Mardihoraires.length) {
        var MardiouvertureMatin = Mardihoraires[0];
        var MardifermetureMatin = Mardihoraires[1];
        var MardiouvertureApresmidi = Mardihoraires[2];
        var MardifermetureApresmidi = Mardihoraires[3];

        $('#mardi-matin-ouverture').val(MardiouvertureMatin);
        $('#mardi-matin-fermeture').val(MardifermetureMatin);
        $('#mardi-apresmidi-ouverture').val(MardiouvertureApresmidi);
        $('#mardi-apresmidi-fermeture').val(MardifermetureApresmidi);
    }
}

if (mercrediValue) {
    mercredihoraires = mercrediValue.split('-');

    console.log('horaires', mercredihoraires );

    if (mercredihoraires.length) {
        var mercrediouvertureMatin = mercredihoraires[0];
        var mercredifermetureMatin = mercredihoraires[1];
        var mercrediouvertureApresmidi = mercredihoraires[2];
        var mercredifermetureApresmidi = mercredihoraires[3];

        $('#mercredi-matin-ouverture').val(mercrediouvertureMatin);
        $('#mercredi-matin-fermeture').val(mercredifermetureMatin);
        $('#mercredi-apresmidi-ouverture').val(mercrediouvertureApresmidi);
        $('#mercredi-apresmidi-fermeture').val(mercredifermetureApresmidi);
    }
}

if (jeudiValue) {
    jeudihoraires = jeudiValue.split('-');

    console.log('horaires', jeudihoraires );

    if (jeudihoraires.length) {
        var jeudiouvertureMatin = jeudihoraires[0];
        var jeudifermetureMatin = jeudihoraires[1];
        var jeudiouvertureApresmidi = jeudihoraires[2];
        var jeudifermetureApresmidi = jeudihoraires[3];

        $('#jeudi-matin-ouverture').val(jeudiouvertureMatin);
        $('#jeudi-matin-fermeture').val(jeudifermetureMatin);
        $('#jeudi-apresmidi-ouverture').val(jeudiouvertureApresmidi);
        $('#jeudi-apresmidi-fermeture').val(jeudifermetureApresmidi);
    }
}

if (vendrediValue) {
    vendredihoraires = vendrediValue.split('-');

    console.log('horaires', vendredihoraires );

    if (vendredihoraires.length) {
        var vendrediouvertureMatin = vendredihoraires[0];
        var vendredifermetureMatin = vendredihoraires[1];
        var vendrediouvertureApresmidi = vendredihoraires[2];
        var vendredifermetureApresmidi = vendredihoraires[3];

        $('#vendredi-matin-ouverture').val(vendrediouvertureMatin);
        $('#vendredi-matin-fermeture').val(vendredifermetureMatin);
        $('#vendredi-apresmidi-ouverture').val(vendrediouvertureApresmidi);
        $('#vendredi-apresmidi-fermeture').val(vendredifermetureApresmidi);
    }
}

if (samediValue) {
    samedihoraires = samediValue.split('-');

    console.log('horaires', samedihoraires );

    if (samedihoraires.length) {
        var samediouvertureMatin = samedihoraires[0];
        var samedifermetureMatin = samedihoraires[1];
        var samediouvertureApresmidi = samedihoraires[2];
        var samedifermetureApresmidi = samedihoraires[3];

        $('#samedi-matin-ouverture').val(samediouvertureMatin);
        $('#samedi-matin-fermeture').val(samedifermetureMatin);
        $('#samedi-apresmidi-ouverture').val(samediouvertureApresmidi);
        $('#samedi-apresmidi-fermeture').val(samedifermetureApresmidi);
    }
}

if (dimancheValue) {
    dimanchehoraires = dimancheValue.split('-');

    console.log('horaires', dimanchehoraires );

    if (dimanchehoraires.length) {
        var dimancheouvertureMatin = dimanchehoraires[0];
        var dimanchefermetureMatin = dimanchehoraires[1];
        var dimancheouvertureApresmidi = dimanchehoraires[2];
        var dimanchefermetureApresmidi = dimanchehoraires[3];

        $('#dimanche-matin-ouverture').val(dimancheouvertureMatin);
        $('#dimanche-matin-fermeture').val(dimanchefermetureMatin);
        $('#dimanche-apresmidi-ouverture').val(dimancheouvertureApresmidi);
        $('#dimanche-apresmidi-fermeture').val(dimanchefermetureApresmidi);
    }
}


$('#prodForm').submit(function(e) {
    e.preventDefault();

    var lundiMatinOuverture = $('#lundi-matin-ouverture').val();
    var lundiMatinFermeture = $('#lundi-matin-fermeture').val();
    var lundiApresmidiOuverture = $('#lundi-apresmidi-ouverture').val();
    var lundiApresmidiFermeture = $('#lundi-apresmidi-fermeture').val();
    var lundiValue = generateFormattedTimeRange(lundiMatinOuverture, lundiMatinFermeture) + ' - ' + generateFormattedTimeRange(lundiApresmidiOuverture, lundiApresmidiFermeture);
    mardiMatinOuverture = $('#mardi-matin-ouverture').val();
    mardiMatinFermeture = $('#mardi-matin-fermeture').val();
    mardiApresmidiOuverture = $('#mardi-apresmidi-ouverture').val();
    mardiApresmidiFermeture = $('#mardi-apresmidi-fermeture').val();
    mardiValue = generateFormattedTimeRange(mardiMatinOuverture, mardiMatinFermeture) + ' - ' + generateFormattedTimeRange(mardiApresmidiOuverture, mardiApresmidiFermeture);
    mercrediMatinOuverture = $('#mercredi-matin-ouverture').val();
    mercrediMatinFermeture = $('#mercredi-matin-fermeture').val();
    mercrediApresmidiOuverture = $('#mercredi-apresmidi-ouverture').val();
    mercrediApresmidiFermeture = $('#mercredi-apresmidi-fermeture').val();
    mercrediValue = generateFormattedTimeRange(mercrediMatinOuverture, mercrediMatinFermeture) + ' - ' + generateFormattedTimeRange(mercrediApresmidiOuverture, mercrediApresmidiFermeture);
    jeudiMatinOuverture = $('#jeudi-matin-ouverture').val();
    jeudiMatinFermeture = $('#jeudi-matin-fermeture').val();
    jeudiApresmidiOuverture = $('#jeudi-apresmidi-ouverture').val();
    jeudiApresmidiFermeture = $('#jeudi-apresmidi-fermeture').val();
    jeudiValue = generateFormattedTimeRange(jeudiMatinOuverture, jeudiMatinFermeture) + ' - ' + generateFormattedTimeRange(jeudiApresmidiOuverture, jeudiApresmidiFermeture);
    vendrediMatinOuverture = $('#vendredi-matin-ouverture').val();
    vendrediMatinFermeture = $('#vendredi-matin-fermeture').val();
    vendrediApresmidiOuverture = $('#vendredi-apresmidi-ouverture').val();
    vendrediApresmidiFermeture = $('#vendredi-apresmidi-fermeture').val();
    vendrediValue = generateFormattedTimeRange(vendrediMatinOuverture, vendrediMatinFermeture) + ' - ' + generateFormattedTimeRange(vendrediApresmidiOuverture, vendrediApresmidiFermeture);
    samediMatinOuverture = $('#samedi-matin-ouverture').val();
    samediMatinFermeture = $('#samedi-matin-fermeture').val();
    samediApresmidiOuverture = $('#samedi-apresmidi-ouverture').val();
    samediApresmidiFermeture = $('#samedi-apresmidi-fermeture').val();
    samediValue = generateFormattedTimeRange(samediMatinOuverture, samediMatinFermeture) + ' - ' + generateFormattedTimeRange(samediApresmidiOuverture, samediApresmidiFermeture);
    dimancheMatinOuverture = $('#dimanche-matin-ouverture').val();
    dimancheMatinFermeture = $('#dimanche-matin-fermeture').val();
    dimancheApresmidiOuverture = $('#dimanche-apresmidi-ouverture').val();
    dimancheApresmidiFermeture = $('#dimanche-apresmidi-fermeture').val();
    dimancheValue = generateFormattedTimeRange(dimancheMatinOuverture, dimancheMatinFermeture) + ' - ' + generateFormattedTimeRange(dimancheApresmidiOuverture, dimancheApresmidiFermeture);


    $('#lundi').val(lundiValue);
    $('#mardi').val(mardiValue);
    $('#mercredi').val(mercrediValue);
    $('#jeudi').val(jeudiValue);
    $('#vendredi').val(vendrediValue);
    $('#samedi').val(samediValue);
    $('#dimanche').val(dimancheValue);

    // console.log('jeudiValue', jeudiValue );

    this.submit();
});

// Fonction pour générer une plage horaire formatée
function generateFormattedTimeRange(ouverture, fermeture) {
    if (ouverture && fermeture) {
        return ouverture + '-' + fermeture;
    } else if (ouverture) {
        // return ouverture + '- Fermé';
        return ouverture + '';
    } else if (fermeture) {
        // return 'Fermé - ' + fermeture;
        return '' + fermeture;
    } else {
        return '';
    }
}








var startlat = {{ $restaurant->lat }};
var startlon = {{ $restaurant->lon }};

var options = {
    center: [startlat, startlon],
    zoom: 12
}

var map = L.map('map', options);
var nzoom = 6;

var greenIcon = L.icon({
    iconUrl: '{{ $url }}build/assets/img/star-1.png',

    iconSize: [50, 50],
    iconAnchor: [50, 50],
    popupAnchor: [-25, -25]
});

L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: 'OSM'
}).addTo(map);

var myMarker = L.marker([startlat, startlon], {
    title: "Coordinates",
    alt: "Coordinates",
    icon: greenIcon,
    draggable: true
}).addTo(map).on('dragend', function() {
    var lat = myMarker.getLatLng().lat.toFixed(8);
    var lon = myMarker.getLatLng().lng.toFixed(8);
    var czoom = map.getZoom();
    if (czoom < 18) {
        nzoom = czoom + 2;
    }
    if (nzoom > 18) {
        nzoom = 18;
    }
    if (czoom != 18) {
        map.setView([lat, lon], nzoom);
    } else {
        map.setView([lat, lon]);
    }
    document.getElementById('lat').value = lat;
    document.getElementById('lon').value = lon;
    myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
    adress_by_lat_lon(lat, lon);
});



function chooseAddr(lat1, lng1)
{
    myMarker.closePopup();
    map.setView([lat1, lng1],15);
    myMarker.setLatLng([lat1, lng1]);
    lat = lat1.toFixed(8);
    lon = lng1.toFixed(8);
    document.getElementById('lat').value = lat;
    document.getElementById('lon').value = lon;
    myMarker.bindPopup("Latitude : "+lat+" <br> Longitude "+lon+"  ").openPopup();
}

function myFunction(arr)
{
    var out = "";
    var i;

    if(arr.length > 0)
    {
        for(i = 0; i < arr.length; i++)
        {
            out += "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat + ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
        }
        document.getElementById('results').innerHTML = out;
    }
    else
    {
        document.getElementById('results').innerHTML = "Pas de résultat...";
    }

    jQuery('#results').show();

}


function adress_search()
{
    var inp = document.getElementById("address");
    var xmlhttp = new XMLHttpRequest();
    var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var myArr = JSON.parse(this.responseText);
            myFunction(myArr);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function adress_by_lat_lon(lat, lon)
{
    var xmlhttp = new XMLHttpRequest();
    var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q="+lat+"+" + lon;
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var myArr = JSON.parse(this.responseText);
            jQuery('#address').val(myArr[0].display_name);
            console.log('myArr.display_name', myArr[0].display_name);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}


jQuery( "body" ).on( "click", "#updateresto", function() {

    jQuery('.wrap_map').html('');
    jQuery('.wrap_map').html('<div id="map" style="width: 100%;height: 250px;"></div>');

    setTimeout(function() {


        var startlat = {{$restaurant->lat}} ;
        var startlon = {{$restaurant->lon}} ;

        var options = {
            center: [startlat, startlon],
            zoom: 5
        }

        var map = L.map('map', options);
        var nzoom = 6;

        var greenIcon = L.icon({
            iconUrl: '{{$url}}build/assets/img/star-1.png',

            iconSize:    [50, 50] ,
            iconAnchor:   [50, 50] ,
            popupAnchor:  [-25, -25]
        });

        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);

        var myMarker = L.marker([startlat, startlon], {
            title: "Coordinates",
            alt: "Coordinates",
            icon: greenIcon,
            draggable: true
        }).addTo(map).on('dragend', function() {
            var lat = myMarker.getLatLng().lat.toFixed(8);
            var lon = myMarker.getLatLng().lng.toFixed(8);
            var czoom = map.getZoom();
            if(czoom < 18) { nzoom = czoom + 2; }
            if(nzoom > 18) { nzoom = 18; }
            if(czoom != 18) { map.setView([lat,lon], nzoom); } else { map.setView([lat,lon]); }
            document.getElementById('lat').value = lat;
            document.getElementById('lon').value = lon;
            myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
            adress_by_lat_lon(lat, lon);
        });


        jQuery( "body" ).on( "keyup", "#address", function() {
            jQuery('#search button').click();
        })

        jQuery( "body" ).on( "click", ".address", function() {
            txt = jQuery( this ).text();
            jQuery('#address').val(txt);
            jQuery('#results').hide();
        });



    }, 250);



});


jQuery( "body" ).on( "keyup", "#address", function() {
    jQuery('#search button').click();
})

jQuery( "body" ).on( "click", ".address", function() {
    txt = jQuery( this ).text();
    jQuery('#address').val(txt);
    jQuery('#results').hide();
});

</script>