


$(document).ready(function() {
    // Función para agregar un producto al carrito
    $('.agregarCarrito').on('click', function(e) {
        e.preventDefault();

      

        
        var productoId = $(this).data('producto');
        var productoNombre = $(this).data('nombre');
        var productoPrecio = $(this).data('precio');
        var cantidad = 1; // Suponemos que la cantidad es 1 por defecto
       
        
        // Datos que se enviarán al backend en formato JSON
        var data = {
            action: 'agregar',
            usuarioId: usuarioId,
            productoId: productoId,
            cantidad: cantidad,
            nombre: productoNombre,
            precio: productoPrecio
        };


        
        alert("datos enviados al ajax: " + JSON.stringify(data));
    

        // Realizamos la solicitud AJAX para agregar el producto al carrito
        $.ajax({
        
            url: '../../carrito/action/agregarCarrito.php', // Este es el archivo PHP donde se maneja la lógica
      
            type: 'POST',
            contentType: 'application/json',  // Especificamos que enviamos datos JSON
            dataType: 'json',  // Esperamos una respuesta JSON del backend
            data: JSON.stringify(data),  // Convertimos los datos a JSON con stringify
            
            success: function(response) {
            
                
                // Manejo de la respuesta JSON
                if (response.success) {
                    alert(response.mensaje); // Mostramos el mensaje de éxito
                } else {
                    alert('Error: ' + response.mensaje); // Mostramos el mensaje de error
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al agregar el producto al carrito: ", error);
            }
        });
    });

    // Función para eliminar un producto del carrito
    $('.eliminarCarrito').on('click', function(e) {
        e.preventDefault();
        
        var productoId = $(this).data('producto');
       
        
        // Datos que se enviarán al backend en formato JSON
        var data = {
            action: 'eliminar',
            usuarioId: usuarioId,
            productoId: productoId
        };

        // Realizamos la solicitud AJAX para eliminar el producto del carrito
        $.ajax({
            url: '../../carrito/action/agregarCarrito.php', // El mismo archivo PHP, con lógica diferente según la acción
            type: 'POST',
            contentType: 'application/json',  // Especificamos que enviamos datos JSON
            dataType: 'json',  // Esperamos una respuesta JSON del backend
            data: JSON.stringify(data),  // Convertimos los datos a JSON con stringify
            success: function(response) {
                // Manejo de la respuesta JSON
                if (response.success) {
                    alert(response.mensaje); // Mostramos el mensaje de éxito
                } else {
                    alert('Error: ' + response.mensaje); // Mostramos el mensaje de error
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al eliminar el producto del carrito: ", error);
            }
        });
    });
});
