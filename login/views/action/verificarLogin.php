<?php
session_start(); // Inicia la sesión si no está iniciada
include_once '../../../configuracion.php';  
include_once '../utils/funciones.php';

// Crear una instancia de la clase Session
$objSesion = new Session();

// Obtiene los datos del login (email y password hash)
$datos = datasubmitted();

$hashedPassword = isset($datos['password']) ? $datos['password'] : '';

// Crear una instancia de ABMUsuario
$usuario = new ABMUsuario();
$objUsuarioRol = new ABMUsuarioRol();

$usuarioData = $usuario->buscar($datos);

// Verifica si se encontró el usuario
if ($usuarioData && count($usuarioData) > 0) {
    $usuarioData = $usuarioData[0]; // Obtenemos el primer usuario (en teoría, solo debería haber uno)

    // Comparar los hashes de la contraseña
    if ($hashedPassword === $usuarioData->getuspass()) {
        $param = ['idusuario' => $usuarioData->getidusuario()]; 
        $usuarioConRol = $objUsuarioRol->buscar($param);
        $usuarioConRol = $usuarioConRol[0];

        // Si el hash coincide, iniciar sesión y almacenar los datos del usuario
        $objSesion->setUsuario($usuarioData->getusnombre());
        $objSesion->setIdUsuario($usuarioData->getidusuario());
        $objSesion->setEmail($usuarioData->getusmail());
        $objSesion->setRol($usuarioConRol->getIdRol());


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
