
<?php
session_start();

include_once '../../controller/session.php'; // Incluye la clase Session
include_once '../../controller/ABMUsuarioRol.php';

// Crear instancia de Session
$objSession = new Session();

$objUsuarioRol = new ABMUsuarioRol();

$rol = $objUsuarioRol->obtenerRol($objSession->getRol());

if ($rol == 1) {
    header('Location: ../Administrador/administrador.php');
} else if ($rol == 2) {
    header('Location: ../Veterinario/vetrinario.php');
} else {
    header('Location: ../Cliente/cliente.php');
}

// Usa el método validar para comprobar si el usuario ha iniciado sesión
if (!$objSession->validar()) {
    // Si no está autenticado, redirige al login
    echo "No se pudo iniciar sesión";
    // header('Location: ../view/login.php');
    exit();
}

?>


