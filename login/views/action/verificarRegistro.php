<?php
session_start();
include_once '../../../configuracion.php';  
include_once '../utils/funciones.php';

// Obtiene los datos enviados
$datos = datasubmitted();


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
        'message' => 'este usuario ya esta registrado'
    ]);
}

