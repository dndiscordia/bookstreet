<?php
if(!isset($_SESSION)){
    session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bookstreet - Libreria Electronica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
    <link href="css/hover.css" rel="stylesheet">
</head>

<body>
<div class="container">
<!-- Header -->
<?php include("includes/header.php");?>

<!-- Navbar -->
<?php include("includes/navbar.php");?>

<!-- Content -->
<?php

?>
<div class="container">
  <div class="row">
            <div class="col-md-4 hvr-float">
              <div class="card mb-4 bg-light shadow-sm">
                <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="images/publicar.jpg" data-holder-rendered="true">
                <div class="card-body">
                  <h4 class="card-text">Publicar un Libro</h4>
                  <p class="card-text">Los usuarios registrados pueden utilizar este espacio para publicar un libro en venta para otro usuarios.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"><a href="add_libro.php">Publicar</a></button>
                    </div>
                    <small class="text-muted">Libros</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 hvr-sink">
              <div class="card mb-4 bg-light shadow-sm">
                <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="images/buscar.jpg" data-holder-rendered="true">
                <div class="card-body">
                  <h4 class="card-text">Buscar un Libro</h4>
                  <p class="card-text">Realiza una busqueda personalizada a traves de nuestros catalogos disponibles y articulos en existencia.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"><a href="search.php">Buscar</a></button>
                    </div>
                    <small class="text-muted">Busqueda</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 hvr-float">
              <div class="card mb-4 bg-light shadow-sm">
                <img class="card-img-top" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="images/paper.jpg" data-holder-rendered="true">
                <div class="card-body">
                  <h4 class="card-text">Publicar un Articulo</h4>
                  <p class="card-text">Los usuarios registrados pueden escribir un articulo para iniciar un foro de discusion.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary"><a href="add_articulo.php">Publicar</a></button>
                    </div>
                    <small class="text-muted">Foros</small>
                  </div>
                </div>
              </div>
            </div>
  </div>
</div>
<?php

?>
</div>
<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>