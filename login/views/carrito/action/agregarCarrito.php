<?php
include_once '../../controller/session.php';
include_once '../utils/funciones.php';



// Deshabilitar la salida de errores PHP como HTML
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Configurar headers para JSON
header('Content-Type: application/json');

$objSession = new Session();

// Obtener el JSON raw del input
$jsonData = file_get_contents('php://input');
$datos = json_decode($jsonData, true);

// Verificar si el JSON es válido
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['success' => false, 'mensaje' => 'Error en el formato JSON']);
    exit;
}

// Verificar si el usuario está logueado
if (!$objSession->isLoggedIn()) {
    echo json_encode(['success' => false, 'mensaje' => 'Debes iniciar sesión']);
    exit;
}

// Crear instancia del modelo ABMCarrito
$abmCarrito = new ABMCarrito();

// Procesar la petición según la acción
try {
    $resultado = $abmCarrito->manejarPeticion();
    echo $resultado; // Ya está en formato JSON
} catch (Exception $e) {
    echo json_encode(['success' => false, 'mensaje' => 'Error: ' . $e->getMessage()]);
}
?>