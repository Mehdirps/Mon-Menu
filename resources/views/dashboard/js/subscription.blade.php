
<script>

   var url = 'https://monmenu.io/api/?tok={{$user->wp_token}}&subs=true';


    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
             $('#subscription').html(response);
             console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('error', error );
                $('#subscription').html('Erreur lors de la récupération des factures');
            }
        });

    </script>