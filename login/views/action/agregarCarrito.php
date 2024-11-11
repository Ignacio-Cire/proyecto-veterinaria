<?php
include_once '../../controller/session.php';
include_once '../utils/funciones.php';
session_start();

$objSession = new Session();
$datos = datasubmitted();

// Asegúrate de que el producto esté disponible en la solicitud
if (isset($datos['producto'])) {
    $producto = $datos['producto'];

    // Agregar el producto al carrito (aquí se puede usar la sesión o una base de datos)
    if (!isset($objSession['carrito'])) {
        $objSession['carrito'] = array();  // Si no hay carrito, lo creamos
    }

    // Si el producto ya está en el carrito, incrementamos la cantidad
    if (array_key_exists($producto, $objSession['carrito'])) {
        $objSession['carrito'][$producto]++;
    } else {
        // Si el producto no está en el carrito, lo agregamos con cantidad 1
        $objSession['carrito'][$producto] = 1;
    }

    // Puedes devolver una respuesta en formato JSON si lo prefieres
    echo json_encode(['success' => true, 'producto' => $producto]);

} else {
    // Si no hay producto en la solicitud
    echo json_encode(['success' => false, 'message' => 'No se especificó un producto']);
}
