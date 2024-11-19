<?php
session_start();
include_once '../../../configuracion.php';  

// Obtiene los datos enviados
$datos = datasubmitted();

error_log(print_r($datos, true)); // Log para verificar los datos enviados

$objAbmUsuario = new ABMUsuario();
$abmUsuario = $objAbmUsuario;




$resultado = $abmUsuario->insertUser($datos);

// Aquí estás enviando una respuesta en formato JSON
if ($resultado) {
    echo json_encode([
        'success' => true, 
        'message' => 'Usuario registrado exitosamente.'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'No se pudo concretar el registro.'
    ]);
}

