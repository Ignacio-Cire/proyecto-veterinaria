<?php

session_start();

// Asegúrate de incluir la clase Session
include_once '../../../configuracion.php';
include_once '../utils/funciones.php';

// Crear la instancia de la clase Session
$objSession = new Session();

// Verificar si el usuario está autenticado
if (!$objSession->validar()) {
    // Si no está logueado, lo redirigimos al login
    header('Location: ../../login.php');
    exit;
}

// Verifica si el usuario es cliente (rol 3)
if ($objSession->getRol() == 3) {
    // Si es cliente, lo redirigimos a una página segura para clientes
    header('Location: ../../../home/index-seguro.php');  // Página específica para clientes
    exit;
} else {
    // Si no es cliente, lo redirigimos a una página diferente
    header('Location: paginaDiferente.php');
    exit;
}



?>
