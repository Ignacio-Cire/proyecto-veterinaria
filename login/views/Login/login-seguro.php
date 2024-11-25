<?php
include_once '../estructura/nav-seguro.php';
include_once '../../../configuracion.php';
include_once '../../controller/session.php';

// Crear la instancia de la clase Session
$objSession = new Session();

// Crea la instancia de la clase AbmUsuario
$objAbmUser = new AbmUsuario();

// Verificar si el usuario está autenticado
if (!$objSession->validar()) {
    header('Location: login.php');
    exit;
}

// Obtener el rol del usuario desde la sesión
$rolUsuario = $objSession->getRol(); // Esto te dará el rol del usuario

//usuario que incio session
$userSession = $objSession->getUsuario()
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1>Bienvenido , <?php echo htmlspecialchars($userSession); ?>!</h1>
<br>


    <!-- Ejemplo de contenido del dashboard -->
    <?php if ($rolUsuario == 3): ?>

        <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Información de tu cuenta
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($objSession->getUsuario()); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($objSession->getEmail()); ?></p>
                    <p><strong>mas info:</strong> <?php echo htmlspecialchars($objSession->getEmail()); ?></p>
                    <!-- Botón para cerrar sesión -->
                <form action="../Login/logout.php" method="POST">
                    <button type="submit" class="btn btn-danger mt-3">Cerrar Sesión</button>
                </form>

    <br>
                </div>
            </div>
        </div>
        <?php endif;?>



        <!-- Mostrar opciones solo para administradores que debe obtener entre otras cosas, los datos de todos los usuarios de la base de datos  -->
        <?php if ($rolUsuario == 1): ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Opciones de Administrador
            </div>
            <div class="card-body">
                <h5>Lista de Usuarios</h5>
                <ul class="list-group">
                    <?php
                    // Verifica que $objAbmUser esté correctamente inicializado
                    if (isset($objAbmUser)) {
                        $usuarios = $objAbmUser->buscar(null); // Método para obtener los usuarios
                        if (!empty($usuarios)) {
                            foreach ($usuarios as $usuario): ?>
                                    <li class="list-group-item">
                                    <strong>ID:</strong> <?php echo htmlspecialchars($usuario->getidusuario()); ?> <br>
                                    <strong>Nombre:</strong> <?php echo htmlspecialchars($usuario->getusnombre()); ?> <br>
                                    <strong>Email:</strong> <?php echo htmlspecialchars($usuario->getusmail()); ?>
                                    </li>
                                <?php endforeach;
                         } else {?>
                                <li class="list-group-item">No hay usuarios registrados.</li>
                            <?php }
                            } else {?>
                        <li class="list-group-item text-danger">Error: Objeto $objAbmUser no inicializado.</li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
<?php endif;?>





        <!-- Mostrar opciones solo para veterniario -->
        <?php if ($rolUsuario == 2): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Opciones de Vendedor
                    </div>
                    <div class="card-body">
                        <a href="vendedor.php" class="btn btn-primary">Administrar Productos</a>
                    </div>
                </div>
            </div>
            <?php endif;?>


<?php
include_once '../estructura/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
