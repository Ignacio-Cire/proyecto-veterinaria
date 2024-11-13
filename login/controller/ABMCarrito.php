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

    // Actualizar la cantidad de un producto en el carrito
    private function actualizarCantidad($idusuario, $idproducto, $nuevaCantidad)
    {
        $this->carrito->setear($idusuario, $idproducto, $nuevaCantidad);
        if ($this->carrito->actualizar()) {
            echo "Cantidad actualizada.";
        } else {
            echo "Error al actualizar la cantidad.";
        }
    }
}
?>
