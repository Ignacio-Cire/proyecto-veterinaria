<?php
include_once '../estructura/nav-seguro.php';
include_once '../../../configuracion.php'; // Configuración general
include_once '../../controller/session.php'; // Controlador de sesión

$objSession = new session;
$usuarioId = $objSession->getidusuario();


echo "<script> var usuarioId = " . json_encode($usuarioId) . "; </script>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Veterinaria</title>
    <!-- Enlace a Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assests/css/style.css">

</head>
<body><br><br>

<div class="container mt-5">
    <h2>Collares</h2>
    <div class="row">
        <!-- Producto 1 -->
        <form  id='collar1' method ='POST'>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../assests/img/img7.webp" class="card-img-top" alt="Collar 1">
                <div class="card-body">
                    <h5 class="card-title">Collar de verde</h5>
                    <p class="card-text">Un collar elegante verde para cualquier ocasión especial. Longitud ajustable.</p>
                    <p class="card-text"><strong>Precio: US$ 29.99</strong></p>
                    <a href="javascript:void(0)" class="btn btn-warning agregarCarrito" data-producto="collar1" data-nombre="Collar verde" data-precio="29.99">Agregar al carrito</a>
                </div>
            </div>
        </div>
        </form>

        <!-- Producto 2 -->
        <form  method ='POST'>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../assests/img/img6.jpg" class="card-img-top" alt="Collar 2">
                <div class="card-body">
                    <h5 class="card-title">Collar de colores</h5>
                    <p class="card-text">Collar de colores ideal para eventos formales y elegantes.</p>
                    <p class="card-text"><strong>Precio: US$ 129.99</strong></p>
                    <a href="javascript:void(0)"  class="btn btn-warning agregarCarrito" data-producto="collar2" data-nombre="Collar de colores" data-precio="129.99">Agregar al carrito</a>
                </div>
            </div>
        </div>
        </form>

        <!-- Producto 3 -->
        <form  id='collar1' method ='POST'>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../assests/img/img5.webp" class="card-img-top" alt="Collar 3">
                <div class="card-body">
                    <h5 class="card-title">Collar de tela</h5>
                    <p class="card-text">Collar de tela con detalles metálicos. Perfecto para looks casuales.</p>
                    <p class="card-text"><strong>Precio: US$ 19.99</strong></p>
                    <a href="javascript:void(0)" class="btn btn-warning agregarCarrito" data-producto="collar3" data-nombre="Collar de tela" data-precio="19.99">Agregar al carrito</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<?php include '../estructura/footer.php'; // Incluir pie de página ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assests/js/agregarCarrito.js"></script>

</body>
</html>
