


$(document).ready(function() {
    // Capturar el clic en el botón "Agregar al carrito"
    $('.agregarCarrito').click(function() {
        var producto = $(this).data('producto');  // Obtener el producto desde el atributo data-producto

        // Realizar la solicitud AJAX
        $.ajax({    
            url: 'agregarCarrito.php',  // El archivo PHP que manejará el carrito
            type: 'GET',  // Usamos GET o POST dependiendo de tu preferencia
            data: { producto: producto },  // Pasamos el nombre del producto
            success: function(response) {
                // Aquí puedes mostrar una notificación o actualizar el carrito visualmente
                alert('Producto agregado al carrito: ' + producto);
                // Puedes hacer cualquier otra acción, como actualizar el contador del carrito
            },
            error: function(xhr, status, error) {
                // Manejar el error en caso de que falle la solicitud
                alert('Hubo un error al agregar el producto al carrito');
            }
        });
    });
});

