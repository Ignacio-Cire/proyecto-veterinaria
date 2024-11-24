<?php
include_once '../estructura/nav.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login con reCAPTCHA</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assests/css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-body">
                <h3 class="text-center mb-4">Iniciar Sesión</h3>
                <form id="loginForm" method="POST">
                    <!-- Campo de Email -->
                    <div class="form-group">
                        <label for="email"></label>
                        <input type="email" id="email" class="form-control" placeholder="Ingrese el email" required>
                    </div>
                    <!-- Campo de Clave -->
                    <div class="form-group">
                        <label for="password"></label>
                        <input type="password" id="password" class="form-control" placeholder="Ingrese la clave" required>
                    </div>
                    <!-- reCAPTCHA -->
                    <div class="form-group text-center">
                        <div class="g-recaptcha" data-sitekey="6LfhnVkqAAAAAG7ueEm-vYRbLO1u2xLsECX_IOIF"></div>
                    </div>
                    <!-- Botón de Iniciar Sesión -->
                    <button type="submit" id="loginButton" class="btn btn-primary btn-block mt-4">Iniciar Sesión</button>
                    <!-- Enlace a Registro -->
                    <p class="text-center mt-3">
                        ¿No tienes cuenta? <a href="registro.php">Regístrate</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <?php 
    include_once '../estructura/footer.php'; 
    ?>
    <script src="../assests/js/agregarCarrito.js"></script>
    <script src="../assests/js/carrito.js"></script>
    <script src="../assests/js/login-ajax.js"></script> <!-- Archivo JS para manejar el clic -->
</body>
</html>
