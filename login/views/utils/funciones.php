<?php

require '../../../vendor/autoload.php';

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

// Función para validar el CAPTCHA usando Guzzle
function validarCaptcha($captcha)
{
    $secretKey = '6LfhnVkqAAAAAAYhv6_sMWmJTAwtMErZLcOiVPvV';
    $client = new Client();

    $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
            'secret' => $secretKey,
            'response' => $captcha,
        ],
    ]);

    $responseKeys = json_decode($response->getBody(), true);

    return isset($responseKeys['success']) && $responseKeys['success'] === true;
}

spl_autoload_register(function ($clase) {
    // echo "Cargamos la clase  ".$clase."<br>" ;
    $directorys = array(
        $GLOBALS['ROOT'] . 'models/',
        $GLOBALS['ROOT'] . 'controller/',
        $GLOBALS['ROOT'] . 'modelo/conector/',
        $GLOBALS['ROOT'] . 'utils/',
    );
    // print_r($directorys) ;
    foreach ($directorys as $directory) {
        if (file_exists($directory . $clase . '.php')) {
            // echo "se incluyo".$directory.$class_name . '.php';
            require_once ($directory . $clase . '.php');
            return;
        }
    }

});
