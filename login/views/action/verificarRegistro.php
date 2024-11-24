<?php
session_start();
include_once '../../../configuracion.php';  
include_once '../utils/funciones.php';

// Obtiene los datos enviados
$datos = datasubmitted();

$objAbmUsuario = new ABMUsuario();


$resultado = $objAbmUsuario->insertUser($datos);

// Aquí estás enviando una respuesta en formato JSON
if ($resultado) {
    echo json_encode([
        'success' => true, 
        'message' => 'Usuario registrado exitosamente.'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Este usuario ya está registrado.'
    ]);
}

