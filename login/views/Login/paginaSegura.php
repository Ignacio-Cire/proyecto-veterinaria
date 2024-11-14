<?php
session_start();

// Asegúrate de incluir la clase Session
include_once '../../controller/session.php'; // O la ruta correcta de tu clase Session

// Crear la instancia de la clase Session
$objSession = new Session();

// Verificar si el usuario está autenticado
if (!$objSession->validar()) {
    echo "No se pudo iniciar sesión. Redirigiendo a la página de login.";
    exit;
}

// Aquí accedes a los datos de la sesión correctamente
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Segura</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido/a!</h1>
        <p>Hola, <?php echo htmlspecialchars($objSession->getUsuario()); ?>. Has iniciado sesión exitosamente.</p>
        
        <!-- Botón para cerrar sesión -->
        <form action="logout.php" method="POST">
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>