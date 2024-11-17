<?php
session_start();
include_once '../utils/funciones.php';
include_once '../../models/conector/BaseDatos.php';
include_once '.././../controller/ABMusuario.php';
include_once '../../models/Usuario.php';

// Obtiene los datos enviados
$datos = datasubmitted();
print_r($datos);
// Obtener los datos enviados por AJAX
$nombreUsuario = $datos['nombreUsuario'] ?? '';
$email = $datos['email'] ?? '';
$password = $datos['password'] ?? '';
$captchaResponse = $datos['g-recaptcha-response'] ?? '';
$datos['accion'] = 'nuevo'; // Asegúrate de que la acción es la correcta

// Verificar si el usuario ya existe
$objAbmUs = new ABMusuario();
$objAbmUs->abm($datos);
$usuario = $objAbmUs->buscar($datos);

if ($usuario) {
    //echo json_encode(['status' => 'error', 'message' => 'El usuario ya está registrado.']);
    $resp = array('status' => 'error', 'message' => 'Usuario registrado correctamente.');

}

//$usuarioRol = new ABMUsuarioRol();

// Insertar el nuevo usuario
/*$datosUsuario = [
'email' => $email,
'password' => $password, // Guardar la contraseña hasheada
];

$insertado = $objAbmUs->insertarUser($datosUsuario);

if ($insertado) {
echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente.']);
} else {
echo json_encode(['status' => 'error', 'message' => 'Error al registrar el usuario.']);
}*/
$resp = array('status' => 'success',
    'message' => 'Usuario registrado correctamente.');
echo json_encode($resp);
