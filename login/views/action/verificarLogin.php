<?php
session_start();
include_once '../utils/funciones.php';
include_once '../../controller/ABMusuario.php';
include_once '../../controller/ABMUsuarioRol.php';
include_once '../../controller/session.php';

$objSesion = new Session();

// Obtiene los datos enviados
$datos = datasubmitted();


// Crear una instancia de Usuario

$usuario = new ABMusuario();
$usuarioRol = new ABMUsuarioRol();

// Llama a tu método para obtener el usuario por email
$usuarioData = $usuario->buscar($datos); //

if ($usuarioData) {
    if (password_verify($password, $usuarioData['password'])) { // Verifica la contraseña

        // Guarda la información del usuario en la sesión
        $rolUs = $usuarioRol->obtenerRol($usuarioData['id']);
        $objSesion->setUsuario($usuarioData['nombreUsuario']);
        $objSesion->setIdUsuario($usuarioData['id']);
        $objSesion->setRol($rolUs);

        exit(); // Asegúrate de llamar a exit() después de la redirección
    } else {
        echo 'La contraseña es incorrecta. Inténtalo de nuevo.';
    }
} else {
    echo 'No existe un usuario con ese email. Por favor, verifica e intenta nuevamente.';
}

exit();
