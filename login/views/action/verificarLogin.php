<?php
session_start(); // Inicia la sesión si no está iniciada
include_once '../../../configuracion.php';  
include_once '../utils/funciones.php';

// Crear una instancia de la clase Session
$objSesion = new Session();

// Obtiene los datos del login (email y password hash)
$datos = datasubmitted();


// Crear una instancia de ABMUsuario
$usuario = new ABMUsuario();

$usuarioData = $usuario->buscar($datos);

$hashedPassword = isset($datos['password']) ? $datos['password'] : '';

// Verifica si se encontró el usuario
if ($usuarioData && count($usuarioData) > 0) {
    $usuarioData = $usuarioData[0]; // Obtenemos el primer usuario 

    // Comparar los hashes de la contraseña
    if ($hashedPassword === $usuarioData->getuspass()) {
        $objSesion->setUsuario($usuarioData->getusnombre());
        $objSesion->setEmail($usuarioData->getusmail());

        echo json_encode(['success' => true, 'message' => 'Login exitoso.']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'La contraseña es incorrecta. Inténtalo de nuevo.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No existe un usuario con esos datos.']);
}

exit();
?>