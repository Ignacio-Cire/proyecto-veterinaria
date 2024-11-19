<?php
require '../../../vendor/autoload.php'; // Composer para manejar dependencias
require '../../../configuracion.php';  // Configuración incluida manualmente

use GuzzleHttp\Client;

// Función para obtener los datos enviados por POST o GET
function datasubmitted()
{
    $datos = array();
    foreach ($_POST as $key => $value) {
        $datos[$key] = $value;
    }
    foreach ($_GET as $key => $value) {
        $datos[$key] = $value;
    }
    return $datos;
}

// // Función para validar el CAPTCHA usando Guzzle
// function validarCaptcha($captcha)
// {
//     $secretKey = '6LfhnVkqAAAAAAYhv6_sMWmJTAwtMErZLcOiVPvV';
//     $client = new Client();

//     $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
//         'form_params' => [
//             'secret' => $secretKey,
//             'response' => $captcha,
//         ],
//     ]);

//     $responseKeys = json_decode($response->getBody(), true);

//     return isset($responseKeys['success']) && $responseKeys['success'] === true;
// }

// Registrar el autoload
spl_autoload_register(function ($clase) {
    $directorys = array(
        __DIR__ . '/../../models/',
        __DIR__ . '/../../controller/',
        __DIR__ . '/../../models/conector/',
        __DIR__ . '/../utils/',
        __DIR__ . '/../../views/',
        __DIR__ . '/../../views/action/',
    );

    foreach ($directorys as $directory) {
        $archivo = $directory . $clase . '.php';
        if (file_exists($archivo)) {
            require_once $archivo;
            return;
        }
    }
});
