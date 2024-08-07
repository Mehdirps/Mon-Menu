<script>

   $('.clear_color').click(function () {
       parent = $(this).parent();
       input = parent.find('input');
       icone = parent.find('i');
       if (input.attr('type') == 'color') {
            input.attr('type','text');
            input.val('');
             icone.removeClass('icon-simple-remove');
            icone.addClass('icon-palette');

       }else{
            input.attr('type','color');

              icone.removeClass('icon-palette');
            icone.addClass('icon-simple-remove');
       }
   });
/*
   $('.wrap_colors input').click(function () {
        clear_color = $(this).parent().find('.clear_color');
        clear_color.click();
   })
*/

/*
apercu
preview_phone_ext
preview_phone_int
preview_phone_banner
preview_phone_title
preview_phone_txt
preview_phone_bts
preview_phone_btn
*/

 $(document).ready(function () {

      $('#theme').change(function () {
        var val = $(this).val();
        console.log('val', val);
        $('.preview_phone_int').css('backgroundColor', val);
      });


      $('#baseColor').change(function () {
        var val = $(this).val();
        $('.preview_phone_txt,.preview_phone_btn span').css('backgroundColor', val);
      });

       $('#titleColor').change(function () {
        var val = $(this).val();
        $('.preview_phone_title').css('backgroundColor', val);
      });



       $('.preview_phone_int').css('backgroundColor', $('#theme').val());

        $('.preview_phone_txt,.preview_phone_btn span').css('backgroundColor', $('#baseColor').val());

         $('.preview_phone_title').css('backgroundColor', $('#titleColor').val());




    });


</script>