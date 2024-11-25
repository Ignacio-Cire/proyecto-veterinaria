


$(document).ready(function() {


    // Función para agregar un producto al carrito
    $('.agregarCarrito').on('click', function(e) {
        e.preventDefault();

        // Captura los valores de los campos del formulario
        var productoId = $(this).data('producto');
        var productoNombre = $(this).data('nombre');
        var productoPrecio = $(this).data('precio');
        var cantidad = 1; // Por defecto, se agrega una unidad del producto
       
        
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
    

         // Petición AJAX para enviar los datos al servidor
         $.ajax({
            type: "POST",
            url: '/proyecto-veterinaria/login/views/carrito/action/agregarCarrito.php', // Archivo PHP donde se manejará la lógica
            data: JSON.stringify(data), // Enviar los datos en formato JSON
            contentType: "application/json", // Importante para enviar JSON correctamente
            success: function (response) {
                try {
                    var res = JSON.parse(response);

                    if (res.success) {
                        // Producto agregado exitosamente
                        alert("Producto agregado al carrito correctamente.");
                    } else {
                        // Error enviado por el servidor
                        alert("No se pudo agregar el producto: " + res.message);
                    }
                } catch (error) {
                    alert("Error procesando la respuesta del servidor.");
                    console.error(error);
                }
            },
            error: function (xhr, status, error) {
                // Manejo de errores en la petición AJAX
                alert("Hubo un error al intentar agregar el producto al carrito.");
                console.error("Error:", error);
            }
        });
    });




    // // Función para eliminar un producto del carrito
    // $('.eliminarCarrito').on('click', function(e) {
    //     e.preventDefault();
        
    //     var productoId = $(this).data('producto');
       
        
    //     // Datos que se enviarán al backend en formato JSON
    //     var data = {
    //         action: 'eliminar',
    //         usuarioId: usuarioId,
    //         productoId: productoId
    //     };

    //     // Realizamos la solicitud AJAX para eliminar el producto del carrito
    //     $.ajax({
    //         url: '../../carrito/action/agregarCarrito.php', // El mismo archivo PHP, con lógica diferente según la acción
    //         type: 'POST',
    //         contentType: 'application/json',  // Especificamos que enviamos datos JSON
    //         dataType: 'json',  // Esperamos una respuesta JSON del backend
    //         data: JSON.stringify(data),  // Convertimos los datos a JSON con stringify
    //         success: function(response) {
    //             // Manejo de la respuesta JSON
    //             if (response.success) {
    //                 alert(response.mensaje); // Mostramos el mensaje de éxito
    //             } else {
    //                 alert('Error: ' + response.mensaje); // Mostramos el mensaje de error
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error("Error al eliminar el producto del carrito: ", error);
    //         }
    //     });
    // });
});
