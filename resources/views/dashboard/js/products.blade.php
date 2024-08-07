<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"
    integrity="sha512-Eezs+g9Lq4TCCq0wae01s9PuNWzHYoCMkE97e2qdkYthpI0pzC3UGB03lgEHn2XM85hDOUF6qgqqszs+iXU4UA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>

<script>
    // $('#items').sortable({
    // handle: '.handle',
    // });


    document.addEventListener('DOMContentLoaded', function() {
        const sortable = new Sortable(document.getElementById('items'), {
            animation: 150,
            handle: '.handle',
            ghostClass: 'sortable-ghost',

            onUpdate: function(evt) {
                const itemEl = evt.item; // Élément déplacé
                const productId = itemEl.getAttribute('data-id'); // ID du produit déplacé
                const newIndex = evt.newIndex; // Nouvel index de l'élément dans la liste

                // Envoi de la requête AJAX pour mettre à jour l'ordre du produit
                fetch('{{ route('products.update-order') }}', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assurez-vous de définir la balise CSRF dans votre template Blade
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            new_index: newIndex,
                        }),
                    })
                    .then(response => {
                        // Vérifier si la requête s'est bien déroulée (statut 200-299)
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Gérer la réponse en cas de succès
                        $('#response').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${data.message}
        </div>
    `);

                        $('#prod-' + productId + ' .item_order').text(data.item_order);
                        $('#items li').each(function(e, i) {
                            $(this).find('.item_order').text(e);

                            id = $(this).data('id');
                            fetch('{{ route('products.update-order') }}', {
                                    method: 'PATCH',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assurez-vous de définir la balise CSRF dans votre template Blade
                                    },
                                    body: JSON.stringify({
                                        product_id: id,
                                        new_index: e,
                                    }),
                                })
                                .then(response => {
                                    // Vérifier si la requête s'est bien déroulée (statut 200-299)
                                    if (!response.ok) {
                                        throw new Error(
                                            'Network response was not ok');
                                    }
                                    return response.json();
                                })
                        })
                        setTimeout(function() {
                            $('#response').html('');
                        }, 1200);
                        console.log('response : ', data);
                        // not.showNotification('bottom', 'right');

                    })
                    .catch(error => {
                        // Gérer les erreurs éventuelles
                        console.error('Error:', error);
                    });
            },
        });
    });




    $('.filter_btn li').click(function() {

        trToShow = $(this).data('show');
        $('.tr_cat').addClass('hide');
        $('.tr_cat').removeClass('show');

        if (trToShow == 'all') {
            $('.tr_cat').removeClass('show');
            $('.tr_cat').removeClass('hide');

        } else {
            $('.tr_cat.' + trToShow + '').removeClass('hide');
            $('.tr_cat.' + trToShow + '').addClass('show');
        }
    })

    $('#searchInput').keyup(function() {
        var searchText = $(this).val().toLowerCase();

        if (searchText == '' || !searchText) {

              setTimeout(function() {
                  $('.variants-wrap').removeClass('variants-active');
                  $('.variants-wrap').hide();
              }, 250);
        }

        $('#items li').each(function() {
          var loginText = $(this).find('.item_name').text().toLowerCase();
          if (loginText.includes(searchText)) {
            $(this).show();
            console.log('parent',$(this).parent() );
            if ($(this).parent().hasClass('variants-wrap')) {
                $(this).parent().show();
                $(this).parent().parent().show();
            }
          } else {
            $(this).hide();
            $('.variants-wrap').removeClass('variants-active');

          }
        });
      });
</script>
