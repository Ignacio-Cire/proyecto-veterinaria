<!-- header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
            <a href="http://localhost:3000/login/views/home/index.php"><img src="../../assests/img/Logo.png" alt="Logo"></a> 
        </div>

        <!-- Barra de búsqueda -->
        <div class="search-bar">
            <input type="text" placeholder="Buscar productos...">
            <button type="submit">Buscar</button>
        </div>

        <!-- Carrito, Login y GitHub -->
        <div class="account-cart">
            <a href="http://localhost:3000/login/views/Login/login.php" class="login">Login</a>


            <a class="cart" href="http://localhost:3000/login/views/carritoMuestra.php">
    <span class="cart-icon">🛒</span> Carrito (<span id="contadorCarrito">0</span>)</a>

            <a class="nav-link" href="https://github.com/Ignacio-Cire/login-security.git" target="_blank">
                <i class="fab fa-github fa-2x"></i>
            </a>
        </div>
    </header>

<!-- Barra de navegación personalizada-->
<div class="navbar">

<!-- Menú de navegación -->
<div class="navbar">
    <!-- Menú de navegación -->
    <div class="nav-links">
        <ul>
            <li><a href="../tienda.php">Tienda</a></li>
            <li><a href="http://localhost:3000/login/views/home/index-seguro.php">Ofertas</a></li>
            <li class="dropdown">
                <a href="#">Categorías</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Perros</a></li>
                    <li><a href="#">Gatos</a></li>
                </ul>
            </li>
            <li><a href="#">Contacto</a></li>
            <!-- <li><a href="#">Turnos</a></li> -->
        </ul>
    </div>
</div>
</nav>


    <!-- Bootstrap JS (para funcionalidades de la barra de navegación o interactividad si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
