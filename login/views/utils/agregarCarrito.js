


$(document).ready(function () {
    // Función para agregar al carrito
    $(".agregarCarrito").on("click", function (event) {
        event.preventDefault();

        // Obtener los datos del producto desde los atributos
        const $producto = $(this);
        const nombre = $producto.data("nombre");
        const precio = parseFloat($producto.data("precio"));
        const id = $producto.data("producto");

        // Obtener el carrito actual desde localStorage
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

        // Crear un objeto para el producto
        const item = {
            id: id,
            nombre: nombre,
            precio: precio
        };

        // Agregar el producto al carrito
        carrito.push(item);

        // Guardar el carrito actualizado en localStorage
        localStorage.setItem("carrito", JSON.stringify(carrito));

        // Mostrar mensaje de éxito--luego cambiar...
        alert(`Producto agregado al carrito: ${nombre}`);

        // Actualizar el contador del carrito
        actualizarContadorCarrito();
    });

    // Función para actualizar el contador del carrito
    function actualizarContadorCarrito() {
        const carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        const contador = carrito.length;

        // Actualizar el contador en el HTML
        $("#contadorCarrito").text(contador);
    }

    // Llama a la función para actualizar el contador al cargar la página
    actualizarContadorCarrito();
});
