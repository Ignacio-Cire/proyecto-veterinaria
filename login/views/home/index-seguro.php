<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estructura/style.css">
</head>
<body>

    <?php 
    include_once '../estructura/nav.php';
    include_once '../../../configuracion.php';
    include_once '../../controller/session.php';    

$objSession = new Session();

?> <!-- Esto es para incluir la barra de navegación si tienes -->

    <div class="container mt-5">
        <h1>Bienvenido a tu Dashboard, <?php echo htmlspecialchars($objSession->getUsuario()); ?>!</h1>
        <p>Este es tu espacio donde podrás gestionar tu cuenta y realizar compras.</p>

        <!-- Ejemplo de contenido del dashboard -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Información de tu cuenta
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($objSession->getUsuario()); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($objSession->getEmail()); ?></p>
                        <!-- Aquí podrías agregar más datos del usuario, como dirección, teléfono, etc. -->
                    </div>
                </div>
            </div>

            <!-- Agrega más secciones o funcionalidades aquí -->
        </div>

        <!-- Botón para cerrar sesión -->
        <form action="../Login/logout.php" method="POST">
            <button type="submit" class="btn btn-danger mt-3">Cerrar Sesión</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>