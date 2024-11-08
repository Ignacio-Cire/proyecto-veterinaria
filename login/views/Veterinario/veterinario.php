<?php
//session_start();

//include_once 'Session.php'; // Incluye la clase Session

// Crear instancia de Session
//$objSession = new Session();

// Usa el método validar para comprobar si el usuario ha iniciado sesión
//if (!$objSession->validar()) {
    // Si no está autenticado, redirige al login
  //  echo "No se pudo iniciar sesión";
    // header('Location: ../view/login.php');
    //exit();
//}

?>

<?php
include_once '../estructura/nav.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Segura</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estructura/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido/a !!</h1>

        <p> <?php //echo htmlspecialchars($session->getUsuario()); ?>. Has iniciado sesión exitosamente.</p>
        
    <div class="container mt-5">
        <div class="dashboard-container">
            <!-- Sidebar con navegación -->

            <!-- Contenido principal -->
            <div class="content">
                <!-- Citas programadas -->
                <div class="card">
                    <div class="card-header">
                        <h5>Citas Programadas</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><button class="btn btn-info">Ver Detalles</button></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><button class="btn btn-info">Ver Detalles</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pacientes recientes -->
                <div class="card">
                    <div class="card-header">
                        <h5>Pacientes Recientes</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"></li>
                            <li class="list-group-item"></li>
                            <li class="list-group-item"></li>
                            <li class="list-group-item"></li>
                        </ul>
                    </div>
                </div>

                <!-- Notificaciones -->
                <div class="card">
                    <div class="card-header">
                        <h5>Gestion de tratamientos</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"></li>
                            <li class="list-group-item"></li>
                        </ul>
                    </div>
                </div>
                <br><br>
                <!-- Botón para cerrar sesión -->
                <form action="logout.php" method="POST">
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </div>
    <br><br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php
include_once '../estructura/footer.php';
?>
</body>
</html>
