<?php
include_once '../estructura/nav.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Veterinaria</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estructura/style.css">
    <link rel="stylesheet" href="styleHome.css">
</head>
<body><br><br>

<nav>
</nav>

<!-- Carrusel de imágenes -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../../../imagen1.jpg" class="d-block w-100" alt="Imagen 1">
        </div>
        <div class="carousel-item">
            <img src="../../../imagen2.jpg" class="d-block w-100" alt="Imagen 2">
        </div>
        <div class="carousel-item">
            <img src="../../../imagen3.jpg" class="d-block w-100" alt="Imagen 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>

<br><br>
<br><br>
<?php
include_once '../estructura/footer.php';
?>
</body>
</html>
