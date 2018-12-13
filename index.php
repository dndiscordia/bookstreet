<?php
if(!isset($_SESSION)){
  session_start();
}
include("conexiones/conexionLocalhost.php");
include("includes/codigoComun.php");
$queryGetLibros = "SELECT * FROM tbllibros";
$resQueryGetLibros = mysql_query($queryGetLibros, $conexionLocalhost) or die ("No se pudo ejecutar el query para obtener todos los usuarios");
$libroDetail = mysql_fetch_assoc($resQueryGetLibros);
$queryGetPosts = "SELECT * FROM tblposts";
$resQueryGetPosts = mysql_query($queryGetPosts, $conexionLocalhost) or die ("No se pudo ejecutar el query para obtener todos los usuarios");
$postDetail = mysql_fetch_assoc($resQueryGetPosts);
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
    <link href="css/blog.css" rel="stylesheet">
    <link href="css/carousel.css" rel="stylesheet">
</head>

<body>

<div class="container">
<!-- Header -->
<?php include("includes/header.php");?>

<!-- Navbar -->
<?php include("includes/navbar.php");?>

<!-- Content -->
    <!-- Carousel -->
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class=""></li>
          <li data-target="#myCarousel" data-slide-to="1" class=""></li>
          <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item">
            <img class="first-slide" src="images/firstSlide.png" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Bookstreet: Un nuevo entorno literario</h1>
                <p>Descubre las maravillas que tiene para ofrecerte Bookstreet, libros, revistas, articulos, blogs, foros y mucho mas en una sola plataforma!</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item active carousel-item-left">
            <img class="second-slide" src="images/secondSlide.png" alt="Second slide">
            <div class="container">
              <div class="carousel-caption">
                <h1>La iniciativa</h1>
                <p>Bookstreet no solo es un lugar para adquirir tus libros, también es un proyecto que busca unir a aquellas personas que comparten un interes en comun: La literatura.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Mas información</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item carousel-item-next carousel-item-left">
            <img class="third-slide" src="images/thirsSlide.png" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>¿Que estas esperando?</h1>
                <p>Explora nuestro catalogo de historias literarias y comparte tus opiniones con los demas!</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Explorar catalogo</a></p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    <!-- Jumbotron -->
      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-12 px-0">
          <h1 class="display-4 font-italic">Stan Lee  1922-2018</h1>
          <p class="lead my-3">Principalmente conocido por haber creado personajes icónicos del mundo del cómic tales como Spider-Man, Hulk, Iron Man, Los 4 Fantásticos, Thor, Los Vengadores, Daredevil, Doctor Strange, X-Men y Bruja Escarlata, entre otros muchos superhéroes.</p>
          <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continuar leyendo...</a></p>
        </div>
      </div>

    <!-- Featured Cards-->
      <div class="row mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary">Producto destacado</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="libro.php?libroId=<?php echo $libroDetail['id'];?>"><?php echo $libroDetail['titulo'];?></a>
              </h3>
              <div class="mb-1 text-muted"><?php echo $libroDetail['fechaPublicacion'];?></div>
              <p class="card-text mb-auto"><?php echo $libroDetail['descripcion'];?></p>
              <a href="libro.php?libroId=<?php echo $libroDetail['id'];?>">Ver producto</a>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="<?php echo $libroDetail['img'];?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-success">Publicacion destacada</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="#"><?php echo $postDetail['titulo'];?></a>
              </h3>
              <div class="mb-1 text-muted"><?php echo $postDetail['date_created'];?></div>
              <p class="card-text mb-auto"><?php echo substr($postDetail['contenido'],0,155);?>. . .</p>
              <a href="articulo.php?postId=<?php echo $postDetail['id'];?>&userId=<?php echo $postDetail['idUsuario'];?>">Continuar leyendo</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  <!-- Featured Posts -->

<!-- Footer -->
<?php include("includes/footer.php");?>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>