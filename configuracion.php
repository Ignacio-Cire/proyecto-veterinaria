<?php

// MODIFICAR SEGÚN TENGAS EL PROYECTO GUARDADO LOCALMENTE
$PROYECTO = '../proyecto-veterinaria/';

// Utilizando __DIR__ para generar rutas absolutas basadas en la ubicación del archivo actual
// __DIR__ devolverá la ruta completa al directorio del archivo 'configuracion.php'
$ROOT = __DIR__ . "/$PROYECTO";    

// Esto asegura que las rutas para imágenes, assets y demás recursos estén bien construidas
$GLOBALS['IMGS'] = $ROOT . "/views/assests/img/";
