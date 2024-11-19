<?php
session_start();
include_once '../../../configuracion.php';  

// Obtiene los datos enviados
$datos = datasubmitted();

$objAbmUsuario = new ABMUsuario();
$abmUsuario = $objAbmUsuario;

echo json_encode($abmUsuario->insertUser($datos));
?>
