
<script>

   var url = 'https://monmenu.io/api/?log={{$user->wp_token}}&include_invoices=true';


    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
             $('#orders_js').html(response);
            },
            error: function(xhr, status, error) {
                console.error('error', error );
                $('#orders_js').html('Erreur lors de la récupération des factures');
            }
        });

    </script>