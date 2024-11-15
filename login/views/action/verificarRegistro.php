<?php
session_start();
include_once 'C:\xampp\htdocs\login-security\login\views\utils\funciones.php'; 
include_once '../../models/conector/BaseDatos.php';
include_once '../../models/Usuario.php';

// Obtiene los datos enviados
$datos = datasubmitted();

if (!$datos) {
    echo 'No se recibieron datos. Por favor, intenta nuevamente.';
    exit;
}

if ($datos) {
    // Extrae los datos del formulario
    $username = $datos['nombreUsuario'];
    $email = $datos['email'];
    $password = $datos['password'];
    $captcha = $datos['g-recaptcha-response'];

    // Verifica si el CAPTCHA está presente
    if (!$captcha) {
        echo 'Por favor, verifica el CAPTCHA.';
        exit;
    }

    // Valida el CAPTCHA
    if (!validarCaptcha($captcha)) {
        echo 'Verificación CAPTCHA fallida. Inténtalo de nuevo.';
        exit; // Asegúrate de salir si falla la validación
    }

    // Crear una instancia de la base de datos
    $baseDatos = new BaseDatos();

    try {
        // Inicia la transacción
        $baseDatos->beginTransaction();

        // Crear una instancia de Usuario
        $usuario = new Usuario($username, $email, password_hash($password, PASSWORD_BCRYPT)); // Usar hash para la contraseña

        if ($baseDatos->Iniciar()) {
            // Llama a tu método para insertar el usuario
            if ($usuario->insertar($baseDatos)) { // Asegúrate de tener un método insertar en tu clase Usuario
                // Obtener el ID del usuario recién insertado
                $idUsuario = $baseDatos->lastInsertId();

                // Verifica que el ID del usuario se haya obtenido correctamente
                if (!$idUsuario) {
                    throw new Exception('No se pudo obtener el ID del usuario insertado.');
                }

                // Imprime el ID para depuración
                echo "ID del usuario insertado: $idUsuario<br>";

                // Insertar el rol (cliente = 3)
                $queryRol = "INSERT INTO usuariorol (idusuario, idrol) VALUES (?, ?)";
                $stmtRol = $baseDatos->prepare($queryRol);
                $stmtRol->bindValue(1, $idUsuario); // ID del usuario insertado
                $stmtRol->bindValue(2, 3);           // Rol cliente (idRol = 3)

                if ($stmtRol->execute()) {
                    // Si todo va bien, confirmamos la transacción
                    $baseDatos->commit();

                    // Mensaje de éxito guardado en la sesión
                    $_SESSION['mensaje'] = 'Registro exitoso. Puedes iniciar sesión ahora.';
                    // Redirige a login.php después de un registro exitoso
                    header('Location: ../Login/login.php');
                    exit();
                } else {
                    // Si falla la inserción del rol, revertir la transacción
                    $baseDatos->rollBack();
                    echo 'Error al asignar el rol al usuario. Intenta de nuevo.';
                }
            } else {
                // Si falla la inserción del usuario, revertir la transacción
                $baseDatos->rollBack();
                echo 'Error al registrar el usuario. Intenta de nuevo.';
            }
        } else {
            echo 'Error en la conexión a la base de datos.'; // Mensaje de error
        }

    } catch (Exception $e) {
        // Si ocurre una excepción, revertir la transacción
        $baseDatos->rollBack();
        echo 'Ocurrió un error inesperado: ' . $e->getMessage();
    }

    exit();
}
?>
