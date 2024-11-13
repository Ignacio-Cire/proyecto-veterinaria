<?php
include_once '../views/estructura/nav.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../views/estructura/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Carrito de Compras</h2>
        <div id="carrito-container">
            <!-- Aquí se mostrará el contenido del carrito -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="lista-carrito">
                    <!-- Productos del carrito se insertan aquí con JavaScript -->
                </tbody>
            </table>
        </div>

        <button id="vaciar-carrito" class="btn btn-danger">Vaciar Carrito</button>
        <!-- Botón para redirigir al login -->
        <button id="finalizar-compra" class="btn btn-success">Pagar</button>
    </div>

   <script src="./utils/carrito.js"></script>

   <script>
    // Redirigir al login cuando se hace clic en el botón "Pagar"
    $('#finalizar-compra').on('click', function() {
        window.location.href = "../views/Login/login.php";
    });
   </script>
</body>
</html>
