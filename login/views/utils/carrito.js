// Función para cargar los productos del carrito
function cargarCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const listaCarrito = $('#lista-carrito');
    listaCarrito.empty();

    // Si el carrito está vacío
    if (carrito.length === 0) {
        listaCarrito.append('<tr><td colspan="3" class="text-center">El carrito está vacío.</td></tr>');
        return;
    }

    // Mostrar los productos del carrito
    carrito.forEach((producto, index) => {
        listaCarrito.append(`
            <tr>
                <td>${producto.nombre}</td>
                <td>US$ ${producto.precio.toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm eliminar-producto" data-index="${index}">Eliminar</button>
                </td>
            </tr>
        `);
    });
}

// Función para eliminar un producto del carrito
function eliminarProducto(index) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito.splice(index, 1);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    cargarCarrito();
    actualizarContadorCarrito();
}

// Función para vaciar el carrito
function vaciarCarrito() {
    localStorage.removeItem('carrito');
    cargarCarrito();
    actualizarContadorCarrito();
}

// Función para actualizar el contador del carrito
function actualizarContadorCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const contador = carrito.length;
    $('.cart').html(`<span class="cart-icon">🛒</span> Carrito (${contador})`);
}

// Evento para eliminar un producto del carrito
$(document).on('click', '.eliminar-producto', function() {
    const index = $(this).data('index');
    eliminarProducto(index);
});

// Evento para vaciar el carrito
$('#vaciar-carrito').on('click', function() {
    if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
        vaciarCarrito();
    }
});



// // Evento para finalizar la compra
// $('#finalizar-compra').on('click', function() {
//     // Hacer una petición AJAX para verificar si el usuario está logueado
//     $.ajax({
//         url: '../action/verificarLogin.php', // Apunta al script que maneja la validación
//         type: 'GET',
//         success: function(response) {
//             if (response.validado) {
//                 // Si el usuario está logueado, proceder con la compra
//                 const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                
//                 if (carrito.length === 0) {
//                     alert('El carrito está vacío. Agrega productos antes de finalizar la compra.');
//                     return;
//                 }

//                 // Llamar al backend para guardar el carrito en la base de datos
//                 $.ajax({
//                     url: '../../models/Carrito.php',  // El script que guarda el carrito en la base de datos
//                     type: 'POST',
//                     data: {
//                         idusuario: response.idusuario, // Usar el idusuario que viene del servidor
//                         productos: carrito
//                     },
//                     success: function(response) {
//                         if (response.success) {
//                             alert('Compra finalizada. Gracias por tu compra.');
//                             // Vaciar carrito local y base de datos si es necesario
//                             localStorage.removeItem('carrito');
//                             cargarCarrito();
//                             actualizarContadorCarrito();
//                         } else {
//                             alert('Hubo un problema al procesar tu compra. Inténtalo nuevamente.');
//                         }
//                     },
//                     error: function() {
//                         alert('Error al finalizar la compra. Por favor, intenta más tarde.');
//                     }
//                 });
//             } else {
//                 // Si no está logueado, redirigir al login
//                 alert('Por favor, inicia sesión o regístrate para continuar con la compra.');
//                 window.location.href = '/login.php'; // Redirige a la página de login
//             }
//         },
//         error: function() {
//             alert('Hubo un error al verificar la sesión. Por favor, intenta nuevamente.');
//         }
//     });
// });


// Cargar los productos del carrito al cargar la página
$(document).ready(function() {
    cargarCarrito();
    actualizarContadorCarrito();
});