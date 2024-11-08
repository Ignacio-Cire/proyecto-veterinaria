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
    <link rel="stylesheet" href="styleAdmin.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Panel de Administración</h1>
        <br>
        <h1>Bienvenido/a !!</h1>

        
        <p> <?php //echo htmlspecialchars($session->getUsuario()); ?>. Has iniciado sesión exitosamente.</p>
        


        <div class="dashboard-container">
            <!-- Sidebar con navegación -->

            <!-- Contenido principal -->
            <div class="content">
                <!-- Dashboard (Resumen) -->
                <div class="row">
                    <!-- Estadísticas de usuarios -->
                    <div class="col-md-3">
                        <div class="card stats-box bg-info">
                            <h4>Clientes Registrados</h4>
                            <div class="number">150</div>
                        </div>
                    </div>
                    <!-- Estadísticas de citas -->
                    <div class="col-md-3">
                        <div class="card stats-box bg-success">
                            <h4>Citas Programadas</h4>
                            <div class="number">10</div>
                        </div>
                    </div>
                    <!-- Estadísticas de productos -->
                    <div class="col-md-3">
                        <div class="card stats-box bg-warning">
                            <h4>Productos Disponibles</h4>
                            <div class="number">120</div>
                        </div>
                    </div>
                    <!-- Estadísticas de veterinarios -->
                    <div class="col-md-3">
                        <div class="card stats-box bg-danger">
                            <h4>Veterinarios Activos</h4>
                            <div class="number">2</div>
                        </div>
                    </div>
                </div>

                <!-- Gestión de Usuarios -->
                <div class="card">
                    <div class="card-header">
                        <h5>Gestión de Usuarios</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Cliente</td>
                                    <td>
                                        <button class="btn btn-info">Ver</button>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Veterinario</td>
                                    <td>
                                        <button class="btn btn-info">Ver</button>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Gestión de Productos -->
                <div class="card">
                    <div class="card-header">
                        <h5>Gestión de Productos</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad Disponible</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-info">Editar</button>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-info">Editar</button>
                                        <button class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Gestión de Citas -->
                <div class="card">
                    <div class="card-header">
                        <h5>Gestión de Citas</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
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
                                    <td></td>
                                    <td>
                                        <button class="btn btn-info">Ver</button>
                                        <button class="btn btn-danger">Cancelar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notificaciones -->
                <div class="card">
                    <div class="card-header">
                        <h5>Notificaciones</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"></li>
                            <li class="list-group-item"></li>
                        </ul>
                        <button class="btn btn-primary mt-3">Enviar Notificación</button>
                    </div>
                </div>
<br>
        <!-- Botón para cerrar sesión -->
        <form action="logout.php" method="POST">
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>

        <br><br>
        <?php
include_once '../estructura/footer.php';
?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

