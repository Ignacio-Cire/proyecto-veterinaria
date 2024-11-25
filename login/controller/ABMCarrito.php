<?php



class ABMCarrito
{
    private $carrito;

    public function __construct()
    {
        $this->carrito = new Carrito();
    }

    // Consultar el carrito de un usuario
    public function verCarrito($idusuario)
    {
        // Obtiene los productos del carrito asociados al usuario
        $productos = $this->carrito->obtenerCarritoPorUsuario($idusuario);

        // Calcula el total del carrito para el usuario
        $total = $this->carrito->obtenerTotalCarrito($idusuario);

        // Mostrar el contenido del carrito
        if (count($productos) > 0) { // Si hay productos en el carrito
            echo "<h2>Carrito de Compras</h2>";

            // Itera sobre cada producto en el carrito y lo muestra
            foreach ($productos as $producto) {
                echo "Producto: {$producto['idproducto']} | Cantidad: {$producto['cantproductos']}<br>";
            }

            // Muestra el total en USD
            echo "<br>Total: $total USD";
        } else { // Si no hay productos en el carrito
            echo "Tu carrito está vacío.";
        }
    }


    // Manejar las peticiones AJAX
    public function manejarPeticion()
    {
        // Recibimos los datos JSON enviados desde AJAX
        $datos = json_decode(file_get_contents('php://input'), true);

        // Verificamos que la acción esté definida
        if (isset($datos['action'])) { // Si existe la clave 'action' en los datos recibidos
            switch ($datos['action']) { // Evaluamos el valor de 'action'
                case 'agregar': // Si la acción es 'agregar'
                    // Llamamos a la función para agregar un producto al carrito
                    return $this->agregarAlCarrito(
                        $datos['usuarioId'], // ID del usuario
                        $datos['productoId'], // ID del producto
                        $datos['cantidad']// Cantidad del producto
                    );
                case 'eliminar': // Si la acción es 'eliminar'
                    // Llamamos a la función para eliminar un producto del carrito
                    return $this->eliminarDelCarrito(
                        $datos['usuarioId'], // ID del usuario
                        $datos['productoId']// ID del producto
                    );
                default: // Si la acción no coincide con 'agregar' o 'eliminar'
                    // Retornamos un mensaje indicando que la acción no es válida
                    return json_encode(['success' => false, 'mensaje' => 'Acción no válida.']);
            }
        }
    }

    // Función para agregar un producto al carrito
    public function agregarAlCarrito($idusuario, $idproducto, $cantidad)
    {
        // Verificar si el producto ya está en el carrito
        $productosEnCarrito = $this->carrito->obtenerCarritoPorUsuario($idusuario);
        // Obtiene los productos actuales en el carrito del usuario desde la base de datos

        foreach ($productosEnCarrito as $producto) { // Recorre los productos en el carrito
            if ($producto['idproducto'] == $idproducto) { // Si el producto ya está en el carrito
                // Actualizar la cantidad del producto en el carrito sumando la nueva cantidad
                $this->actualizarCantidad($idusuario, $idproducto, $producto['procantstock'] + $cantidad);

                // Retornar respuesta indicando que la cantidad fue actualizada
                return json_encode(['success' => true, 'mensaje' => 'Cantidad actualizada en el carrito.']);
            }
        }

        // Si el producto no está en el carrito, lo agregamos como nuevo
        $this->carrito->setear($idusuario, $idproducto, $cantidad);
        // Configura los valores necesarios para agregar el producto (usuario, producto, cantidad)

        if ($this->carrito->insertar()) { // Intenta insertar el producto en el carrito
            // Retornar respuesta indicando que el producto fue agregado correctamente
            return json_encode(['success' => true, 'mensaje' => 'Producto agregado al carrito.']);
        } else { // Si ocurrió un error al insertar
            // Retornar respuesta indicando el error
            return json_encode(['success' => false, 'mensaje' => 'Error al agregar el producto al carrito.']);
        }
    }

    // Función para eliminar un producto del carrito
    public function eliminarDelCarrito($idusuario, $idproducto)
    {
        // Llamamos al método de la clase Carrito para eliminar el producto
        if ($this->carrito->eliminarProducto($idusuario, $idproducto)) {
            // Si la eliminación es exitosa, retornamos un mensaje de éxito
            return json_encode(['success' => true, 'mensaje' => 'Producto eliminado del carrito.']);
        } else {
            // Si ocurre un error, retornamos un mensaje de error
            return json_encode(['success' => false, 'mensaje' => 'Error al eliminar el producto del carrito.']);
        }
    }

    // Función para actualizar la cantidad de un producto en el carrito
    private function actualizarCantidad($idusuario, $idproducto, $nuevaCantidad)
    {
        // Configuramos los datos necesarios para actualizar la cantidad
        $this->carrito->setear($idusuario, $idproducto, $nuevaCantidad);

        // Intentamos actualizar el producto en el carrito
        if ($this->carrito->actualizar()) {
            // Si la actualización es exitosa, retornamos un mensaje de éxito
            return json_encode(['success' => true, 'mensaje' => 'Cantidad actualizada.']);
        } else {
            // Si ocurre un error, retornamos un mensaje de error
            return json_encode(['success' => false, 'mensaje' => 'Error al actualizar la cantidad.']);
        }
    }

}
