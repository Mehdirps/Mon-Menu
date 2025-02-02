<footer class="restaurant-footer">
  <section class="footer-container">

    <div class="restaurant-footer-infos">
      <h4>{{ $restaurant->name }}</h4>
      <span class="footer_separator"></span>
      <!-- /.footer-separator -->
      <p>{{ $restaurant->address }} -
        {{ $restaurant->mobile }}</p>
      </div>

      <div class="restaurant-footer-social-links">
        @if ($restaurant->instagram !== null && $restaurant->instagram !== '')
        <a class="footer-insta" href="{{ $restaurant->instagram }}" target="_blank">


          <svg width="24px" height="24px" viewBox="0 0 2500 2500" xmlns="http://www.w3.org/2000/svg"><defs><radialGradient id="0" cx="332.14" cy="2511.81" r="3263.54" gradientUnits="userSpaceOnUse"><stop offset=".09" stop-color="#fa8f21"/><stop offset=".78" stop-color="#d82d7e"/></radialGradient><radialGradient id="1" cx="1516.14" cy="2623.81" r="2572.12" gradientUnits="userSpaceOnUse"><stop offset=".64" stop-color="#8c3aaa" stop-opacity="0"/><stop offset="1" stop-color="#8c3aaa"/></radialGradient></defs><path d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57" fill="url(#0)"/><path d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57" fill="url(#1)"/></svg>

        </a>
        @endif
        @if ($restaurant->facebook !== null && $restaurant->facebook !== '')
        <a class="footer-fcb" href="{{ $restaurant->facebook }}" target="_blank">


         <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
         <style type="text/css">
          .st0rerer{fill:#1877F2;}
          .st1fdfdf{fill:#FFFFFF;}
        </style>
        <path class="st0rerer" d="M3.6,0h16.8c2,0,3.6,1.6,3.6,3.6v16.8c0,2-1.6,3.6-3.6,3.6H3.6c-2,0-3.6-1.6-3.6-3.6V3.6C0,1.6,1.6,0,3.6,0z"/>
        <path class="st1fdfdf" d="M16.7,15.5l0.5-3.5h-3.3V9.8c0-0.9,0.5-1.9,2-1.9h1.5v-3c0,0-1.4-0.2-2.7-0.2c-2.7,0-4.5,1.7-4.5,4.7V12h-3v3.5
        h3V24h3.7v-8.5H16.7z"/>
      </svg>

    </a>
    @endif
    @if ($restaurant->tripadvisor !== null && $restaurant->tripadvisor !== '')
    <a class="footer-trip" href="{{ $restaurant->tripadvisor }}" target="_blank">
      <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_2_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 38.4 24" style="enable-background:new 0 0 38.4 24;" xml:space="preserve">
<style type="text/css">
  .st0212121212156{fill:#34E0A1;}
</style>
<path class="st0212121212156" d="M9.6,9.6c-2.7,0-4.8,2.2-4.8,4.8s2.2,4.8,4.8,4.8s4.8-2.2,4.8-4.8C14.4,11.7,12.3,9.6,9.6,9.6L9.6,9.6z
   M9.6,17.8c-1.9,0-3.4-1.5-3.4-3.4S7.7,11,9.6,11s3.4,1.5,3.4,3.4C13,16.3,11.5,17.8,9.6,17.8z"/>
<circle class="st0212121212156" cx="9.6" cy="14.4" r="2.4"/>
<path class="st0212121212156" d="M28.8,9.6c-2.7,0-4.8,2.2-4.8,4.8s2.2,4.8,4.8,4.8s4.8-2.2,4.8-4.8S31.5,9.6,28.8,9.6z M28.8,17.8
  c-1.9,0-3.4-1.5-3.4-3.4s1.5-3.4,3.4-3.4c1.9,0,3.4,1.5,3.4,3.4C32.2,16.3,30.7,17.8,28.8,17.8z"/>
<circle class="st0212121212156" cx="28.8" cy="14.4" r="2.4"/>
<path class="st0212121212156" d="M35.6,7.6l2.8-2.8h-5.7C29.4,2.2,24.1,0,19.2,0C14.2,0,8.9,2.2,5.7,4.8H0l2.8,2.8C1.1,9.3,0,11.7,0,14.4
  C0,19.7,4.3,24,9.6,24c2.4,0,4.7-0.9,6.4-2.4l3.3,2.4l3.2-2.3l0-0.1c1.7,1.5,3.9,2.4,6.4,2.4c5.3,0,9.6-4.3,9.6-9.6
  C38.4,11.7,37.3,9.3,35.6,7.6L35.6,7.6z M27.6,4.9c-4.5,0.6-8.1,4.3-8.4,9c-0.3-4.6-3.9-8.4-8.4-9c2.3-1.6,5.2-2.5,8.4-2.5
  S25.3,3.2,27.6,4.9z M9.6,21.6c-4,0-7.2-3.2-7.2-7.2s3.2-7.2,7.2-7.2s7.2,3.2,7.2,7.2C16.8,18.4,13.6,21.6,9.6,21.6z M28.8,21.6
  c-4,0-7.2-3.2-7.2-7.2s3.2-7.2,7.2-7.2s7.2,3.2,7.2,7.2C36,18.4,32.8,21.6,28.8,21.6z"/>
</svg>

    </a>
    @endif
    @if ($restaurant->website !== null && $restaurant->website !== '')
    <a class="footer-website" href="{{ $restaurant->website }}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24"
      height="24" viewBox="0 0 24 24">
      <path fill="currentColor"
      d="M16.36 14c.08-.66.14-1.32.14-2c0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2m-5.15 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 0 1-4.33 3.56M14.34 14H9.66c-.1-.66-.16-1.32-.16-2c0-.68.06-1.35.16-2h4.68c.09.65.16 1.32.16 2c0 .68-.07 1.34-.16 2M12 19.96c-.83-1.2-1.5-2.53-1.91-3.96h3.82c-.41 1.43-1.08 2.76-1.91 3.96M8 8H5.08A7.923 7.923 0 0 1 9.4 4.44C8.8 5.55 8.35 6.75 8 8m-2.92 8H8c.35 1.25.8 2.45 1.4 3.56A8.008 8.008 0 0 1 5.08 16m-.82-2C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2c0 .68.06 1.34.14 2M12 4.03c.83 1.2 1.5 2.54 1.91 3.97h-3.82c.41-1.43 1.08-2.77 1.91-3.97M18.92 8h-2.95a15.65 15.65 0 0 0-1.38-3.56c1.84.63 3.37 1.9 4.33 3.56M12 2C6.47 2 2 6.5 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2Z" />
    </svg></a>
    @endif
    @if ($restaurant->tiktok !== null && $restaurant->tiktok !== '')
    <a class="footer-tiktok" href="{{ $restaurant->tiktok }}" target="_blank">


      <svg style="width: 24px;height: 24px;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 21.2 24" style="enable-background:new 0 0 21.2 24;" xml:space="preserve">
<style type="text/css">
  .st01212{fill:#EE1D52;}
  .st1kfjgkfglf{fill:#FFFFFF;}
  .st2gfjkfglkfgf{fill:#69C9D0;}
</style>
<g>
  <path class="st01212" d="M15.7,8.7c1.5,1.1,3.4,1.8,5.5,1.8V6.5c-0.4,0-0.8,0-1.2-0.1v3.1c-2.1,0-3.9-0.7-5.5-1.8v8
    c0,4-3.3,7.3-7.3,7.3c-1.5,0-2.9-0.5-4.1-1.2C4.6,23.2,6.4,24,8.4,24c4,0,7.3-3.3,7.3-7.3L15.7,8.7L15.7,8.7z M17.2,4.7
    c-0.8-0.9-1.3-2-1.4-3.2V1h-1.1C14.9,2.5,15.9,3.9,17.2,4.7L17.2,4.7z M5.8,18.7c-0.4-0.6-0.7-1.3-0.7-2c0-1.8,1.5-3.3,3.3-3.3
    c0.3,0,0.7,0.1,1,0.2v-4C9.1,9.4,8.7,9.4,8.3,9.4v3.1c-0.3-0.1-0.7-0.2-1-0.2c-1.8,0-3.3,1.5-3.3,3.3C3.9,17,4.7,18.2,5.8,18.7z"/>
  <path class="st1kfjgkfglf" d="M14.6,7.7c1.6,1.1,3.4,1.8,5.5,1.8V6.4c-1.1-0.2-2.2-0.8-2.9-1.7c-1.3-0.8-2.2-2.2-2.5-3.7h-2.9v15.8
    c0,1.8-1.5,3.3-3.3,3.3c-1.1,0-2-0.5-2.7-1.3c-1.1-0.5-1.8-1.7-1.8-3c0-1.8,1.5-3.3,3.3-3.3c0.4,0,0.7,0.1,1,0.2V9.4
    c-4,0.1-7.1,3.3-7.1,7.3c0,2,0.8,3.8,2.1,5.1C4.4,22.6,5.8,23,7.3,23c4,0,7.3-3.3,7.3-7.3L14.6,7.7z"/>
  <path class="st2gfjkfglkfgf" d="M20.1,6.4V5.5c-1,0-2-0.3-2.9-0.8C17.9,5.5,19,6.1,20.1,6.4z M14.6,1c0-0.2,0-0.3-0.1-0.5V0h-4v15.8
    c0,1.8-1.5,3.3-3.3,3.3c-0.5,0-1-0.1-1.5-0.4C6.4,19.5,7.4,20,8.4,20c1.8,0,3.3-1.5,3.3-3.3V1H14.6z M8.3,9.4V8.5
    c-0.3,0-0.7-0.1-1-0.1c-4,0-7.3,3.3-7.3,7.3c0,2.5,1.3,4.7,3.2,6.1c-1.3-1.3-2.1-3.1-2.1-5.1C1.2,12.7,4.3,9.5,8.3,9.4L8.3,9.4z"/>
</g>
</svg>


    </a>
    @endif

    @if ($restaurant->google_review_link !== null && $restaurant->google_review_link !== '')
    <a class="footer-google_review_link" href="{{ $restaurant->google_review_link }}" target="_blank">



      <svg width="24px" height="24px" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/></svg>


    </a>
    @endif
  </div>


  <div class="wrapBtnSave">
    <button id="btnSave" class="btnSave" onclick="downloadVCard()">Enregistrer les coordonnées</button>

  </div>

</section>

<div class="copyright">
  <p>&#169; Copyright - 2023 Powered by <a href="https://www.monmenu.io/" target="_blank">monmenu.io</a></p>
</div>
</footer>






<script>

  function downloadVCard() {
  // Récupérer les données de contact
  var nom = '{{ $restaurant->name }}';
  var email = '{{$restaurant->users[0]->email}}';
  var telephone = '{{ $restaurant->mobile }}';

  // Générer le contenu de la vCard
  var vCard = `BEGIN:VCARD
  VERSION:3.0
  N:${nom};;;
  EMAIL:${email}
  TEL:${telephone}
  END:VCARD`;

  // Créer un objet Blob avec le contenu de la vCard
  var blob = new Blob([vCard], { type: 'text/vcard;charset=utf-8' });

  // Créer un lien d'ancrage pour le téléchargement
  var link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = 'contact.vcf';

  // Ajouter le lien au document et cliquer dessus pour déclencher le téléchargement
  document.body.appendChild(link);
  link.click();

  // Nettoyer après le téléchargement
  document.body.removeChild(link);
}

</script>