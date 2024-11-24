<?php
require_once 'models/Carrito.php';

class ABMCarrito
{
    private $carrito;

    public function __construct()
    {
        $this->carrito = new Carrito();
    }

    // Agregar un producto al carrito
    public function agregarProducto($idusuario, $idproducto, $cantproductos)
    {
        // Verificar si el producto ya está en el carrito
        $productosEnCarrito = $this->carrito->obtenerCarritoPorUsuario($idusuario);

        foreach ($productosEnCarrito as $producto) {
            if ($producto['idproducto'] == $idproducto) {
                // Si ya existe, actualizar la cantidad
                $this->actualizarCantidad($idusuario, $idproducto, $producto['cantproductos'] + $cantproductos);
                return;
            }
        }

        // Si no existe, agregar el producto al carrito
        $this->carrito->setear($idusuario, $idproducto, $cantproductos);
        if ($this->carrito->insertar()) {
            echo "Producto agregado al carrito.";
        } else {
            echo "Error al agregar el producto al carrito.";
        }
    }

    // Eliminar un producto del carrito
    public function eliminarProducto($idusuario, $idproducto)
    {
        if ($this->carrito->eliminarProducto($idusuario, $idproducto)) {
            echo "Producto eliminado del carrito.";
        } else {
            echo "Error al eliminar el producto.";
        }
    }

    // Vaciar el carrito
    public function vaciarCarrito($idusuario)
    {
        if ($this->carrito->vaciarCarrito($idusuario)) {
            echo "Carrito vacío.";
        } else {
            echo "Error al vaciar el carrito.";
        }
    }

    // Consultar el carrito de un usuario
    public function verCarrito($idusuario)
    {
        $productos = $this->carrito->obtenerCarritoPorUsuario($idusuario);
        $total = $this->carrito->obtenerTotalCarrito($idusuario);

        // Mostrar el contenido del carrito
        if (count($productos) > 0) {
            echo "<h2>Carrito de Compras</h2>";
            foreach ($productos as $producto) {
                echo "Producto: {$producto['idproducto']} | Cantidad: {$producto['cantproductos']}<br>";
            }
            echo "<br>Total: $total USD";
        } else {
            echo "Tu carrito está vacío.";
        }
    }




    public function manejarPeticion()
    {
        // Recibimos los datos JSON enviados desde AJAX
        $datos = json_decode(file_get_contents('php://input'), true);

        // Verificamos que la acción esté definida
        if (isset($datos['action'])) {
            switch ($datos['action']) {
                case 'agregar':
                    return $this->agregarAlCarrito(
                        $datos['usuarioId'],
                        $datos['productoId'],
                        $datos['cantidad']
                    );
                case 'eliminar':
                    return $this->eliminarDelCarrito(
                        $datos['usuarioId'],
                        $datos['productoId']
                    );
                default:
                    return json_encode(['success' => false, 'mensaje' => 'Acción no válida.']);
            }
        }
    }
    



    // Función para agregar un producto al carrito
    public function agregarAlCarrito($idusuario, $idproducto, $cantidad)
    {
        // Verificar si el producto ya está en el carrito
        $productosEnCarrito = $this->carrito->obtenerCarritoPorUsuario($idusuario);

        foreach ($productosEnCarrito as $producto) {
            if ($producto['idproducto'] == $idproducto) {
                // Si el producto ya existe en el carrito, actualizamos la cantidad
                $this->actualizarCantidad($idusuario, $idproducto, $producto['procantstock'] + $cantidad);
                return json_encode(['success' => true, 'mensaje' => 'Cantidad actualizada en el carrito.']);
            }
        }

        // Si el producto no está en el carrito, agregamos el nuevo producto
        $this->carrito->setear($idusuario, $idproducto, $cantidad);
        if ($this->carrito->insertar()) {
            return json_encode(['success' => true, 'mensaje' => 'Producto agregado al carrito.']);
        } else {
            return json_encode(['success' => false, 'mensaje' => 'Error al agregar el producto al carrito.']);
        }
    }




    // Función para eliminar un producto del carrito
    public function eliminarDelCarrito($idusuario, $idproducto)
    {
        // Llamamos al método de la clase Carrito para eliminar el producto
        if ($this->carrito->eliminarProducto($idusuario, $idproducto)) {
            return json_encode(['success' => true, 'mensaje' => 'Producto eliminado del carrito.']);
        } else {
            return json_encode(['success' => false, 'mensaje' => 'Error al eliminar el producto del carrito.']);
        }
    }



    // Actualizar la cantidad de un producto en el carrito
    private function actualizarCantidad($idusuario, $idproducto, $nuevaCantidad)
    {
        $this->carrito->setear($idusuario, $idproducto, $nuevaCantidad);
        if ($this->carrito->actualizar()) {
            return json_encode(['success' => true, 'mensaje' => 'Cantidad actualizada.']);
        } else {
            return json_encode(['success' => false, 'mensaje' => 'Error al actualizar la cantidad.']);
        }
    }
}


?>
