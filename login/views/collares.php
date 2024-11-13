<?php
include_once '../views/estructura/nav.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Veterinaria</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../views/estructura/style.css">
    <link rel="stylesheet" href="styleHome.css">
</head>
<body><br><br>

<div class="container mt-5">
    <h2>Collares</h2>
    <div class="row">
        <!-- Producto 1 -->
        <form>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../assests/img/img7.webp" class="card-img-top" alt="Collar 1">
                <div class="card-body">
                    <h5 class="card-title">Collar de Plata</h5>
                    <p class="card-text">Un collar elegante de plata para cualquier ocasión especial. Longitud ajustable.</p>
                    <p class="card-text"><strong>Precio: US$ 29.99</strong></p>
                    <a href="javascript:void(0);" class="btn btn-warning agregarCarrito" data-producto="collar1" data-nombre="Collar de Plata" data-precio="29.99">Agregar al carrito</a>
                </div>
            </div>
        </div>
        </form>

        <!-- Producto 2 -->
        <form>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../assests/img/img6.jpg" class="card-img-top" alt="Collar 2">
                <div class="card-body">
                    <h5 class="card-title">Collar de Oro</h5>
                    <p class="card-text">Collar de oro de 18 quilates, ideal para eventos formales y elegantes.</p>
                    <p class="card-text"><strong>Precio: US$ 129.99</strong></p>
                    <a href="javascript:void(0);" class="btn btn-warning agregarCarrito" data-producto="collar2" data-nombre="Collar de Oro" data-precio="129.99">Agregar al carrito</a>
                </div>
            </div>
        </div>
        </form>

        <!-- Producto 3 -->
        <form>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../assests/img/img5.webp" class="card-img-top" alt="Collar 3">
                <div class="card-body">
                    <h5 class="card-title">Collar de Cuero</h5>
                    <p class="card-text">Collar de cuero con detalles metálicos. Perfecto para looks casuales.</p>
                    <p class="card-text"><strong>Precio: US$ 19.99</strong></p>
                    <a href="javascript:void(0);" class="btn btn-warning agregarCarrito" data-producto="collar3" data-nombre="Collar de Cuero" data-precio="19.99">Agregar al carrito</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<?php include './estructura/footer.php'; // Incluir pie de página ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../views/utils/agregarCarrito.js"></script>

</body>
</html>
