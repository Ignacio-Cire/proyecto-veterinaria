<?php

include_once __DIR__ . "../";

$GLOBALS['ROOT'] =$_SERVER['DOCUMENT_ROOT'] ."/proyecto-veterinaria/";
include_once("./login/views/utils/funciones.php");


// MODIFICAR SEGÚN TENGAS EL PROYECTO GUARDADO LOCALMENTE
$PROYECTO = '../proyecto-veterinaria/';

// ALMACENA EL DIRECTORIO DEL PROYECTO
$ROOT = $_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";    

$GLOBALS['IMGS'] = $ROOT . "Vista/img/"; //NOMBRAR CARPETA GALERIA O PROFESIONALES SEGÚN CORRESPONDA
?>