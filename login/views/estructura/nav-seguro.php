<!-- nav-seguro.php -->
<?php
include_once '../../../configuracion.php'; // Configuración general
include_once '../utils/funciones.php'; // Funciones comunes

$objSession = new Session(); // Instancia de la sesión

// Verificar si el usuario está autenticado
if (!$objSession->validar()) {
    header('Location: ../Login/login.php');
    exit;
}

// Obtener el rol del usuario desde la sesión
$rolUsuario = $objSession->getRol(); // Esto te dará el rol del usuario

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body>
    <nav>
        <!-- Segundo encabezado para redes sociales -->
        <div class="social-header">
            <div class="social-icons">
                <a href="https://www.facebook.com/wfwerfwrfewref" target="_blank">Facebook</a>
                <a href="https://www.instagram.com/wfwerfwrfewref" target="_blank">Instagram</a>
                <a href="https://twitter.com/wfwerfwrfewref" target="_blank">Twitter</a>
            </div>
        </div>

        <!-- Primer encabezado principal -->
        <header>
            <!-- Logo y Nombre -->
            <div class="logo">
                <a href="http://localhost:3000/login/views/home/index-seguro.php">
                    <img src="../assests/img/Logo.png" alt="Logo">
                </a>
            </div>

            <!-- Barra de búsqueda -->
            <div class="search-bar" style="padding-left: 150px;">
                <input type="text" placeholder="Buscar productos...">
                <button type="submit">Buscar</button>
            </div>

            <div class="account-cart">
                <!-- Verifica si el usuario está logueado -->
                <?php if ($objSession->activa()): ?>
                    <span class="login text-white"><?php echo htmlspecialchars($objSession->getUsuario()); ?></span>

                    <!-- Menú desplegable -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-user fa-2x"></i> <!-- Icono de usuario -->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUsuario">
                                <li><a class="dropdown-item" href="../Login/login-seguro.php">Mi perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="../Login/logout.php" method="POST" class="d-inline">
                                        <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php endif;?>



                <?php if ($rolUsuario == 3): ?>
                <!-- Carrito -->
                <a class="cart ms-3 text-decoration-none" href="../carrito/carritoMuestra.php">
                    <span class="cart-icon">🛒</span> Carrito (<span id="contadorCarrito">0</span>)
                </a>
                <?php endif;?>



                <!-- GitHub -->
                <a class="nav-link ms-3" href="https://github.com/Sofia-Nb/Proyecto-veterinaria" target="_blank">
                    <i class="fab fa-github fa-2x"></i>
                </a>
            </div>
        </header>

        <!-- Barra de navegación personalizada -->
        <div class="navbar">
            <div class="nav-links">
                <ul>

                    <?php if ($rolUsuario == 1): ?>
                        <li><a href="eliminar_usuarios.php" class="btn btn-danger">Eliminar Usuarios</a></li>
                        <li><a href="asignar_roles.php" class="btn btn-success">Asignar Roles</a></li>
                        <li><a href="gestion_productos.php" class="btn btn-info">Gestionar Productos</a></li>
                        <li><a href="gestion_productos.php" class="btn btn-primary">Gestionar Compras</a></li>

                        <?php elseif ($rolUsuario == 2): ?>
                        <li><a href="asignar_roles.php" class="btn btn-info">Gestionar Productos</a></li>
                        <li><a href="gestion_productos.php" class="btn btn-primary">Gestionar Compras</a></li>

                        <?php elseif ($rolUsuario == 3): ?>
                    <li><a href="../tienda/tienda-segura.php">Productos</a></li>
                    <li><a href="#">Contacto</a></li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
